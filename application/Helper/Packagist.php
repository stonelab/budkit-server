<?php

namespace Helper;

use Composer\Console\Application;
use Composer\Factory;
use Composer\IO\BufferIO;
use Composer\Package\RootPackageInterface;
use Composer\Repository\RepositoryManager;
use Symfony\Component\Console\Output\OutputInterface;
use Composer\Installer;
use Composer\Plugin\CommandEvent;
use Composer\Plugin\PluginEvents;
use Composer\Package\Loader\ArrayLoader;
use Composer\Package\Loader\ValidatingArrayLoader;
use Composer\Console\HtmlOutputFormatter;
use Composer\Repository\VcsRepository;
use Composer\Repository\PlatformRepository;
use Composer\Semver\Comparator;
use Composer\Semver\Semver;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;

class Packagist{

    const VENDOR_DIR = PATH_APP.'/extensions';


    public static function install( $packages ) {

        // Don't proceed if packages haven't changed.
        if ($packages == self::dump()) { return false; }
        putenv('COMPOSER_HOME=' . PATH_VENDOR . '/bin/composer');
        self::createComposerJson($packages);
        chdir(PATH_BASE);

        // Setup composer output formatter
        $stream = fopen('php://temp', 'w+');
        $output = new StreamOutput($stream);
        // Programmatically run `composer install`
        $application = new Application();
        $application->setAutoExit(false);
        $code = $application->run(new ArrayInput(array('command' => 'install')), $output);
        // remove composer.lock
        if (file_exists(PATH_BASE . 'composer.lock')) {
            unlink(PATH_BASE . 'composer.lock');
        }
        // rewind stream to read full contents
        rewind($stream);
        return stream_get_contents($stream);

    }


    /**
     * Get all required packages
     *
     * @param bool|false $noDev
     * @return \Composer\Package\Link[]
     */
    private static function getRequiredPackages(RootPackageInterface $rootPackage, $noDev = false)
    {
        //$rootPackage = $this->getComposer()->getPackage();

        // Required packages
        $packages = $rootPackage->getRequires();

        // Add dev packages
        if (!$noDev) {
            $packages = array_merge($packages, $rootPackage->getDevRequires());
        }

        // Remove platform and extensions
        $platformRepository = new PlatformRepository();
        foreach ($platformRepository->getPackages() as $platformPackage) {
            if (array_key_exists($platformPackage->getPrettyName(), $packages)) {
                unset($packages[$platformPackage->getPrettyName()]);
            }
        }

        return $packages;
    }

    /**
     * Get latest versions of required packages
     *
     * @param \Composer\Package\Link[] $requiredPackages
     * @param bool $preferStable
     * @return array
     */
    private static function getLatestVersions(RepositoryManager $repositoryManager, $requiredPackages, $preferStable = true)
    {
        //$repositoryManager = $this->getComposer()->getRepositoryManager();

        $versions = array();

        foreach ($requiredPackages as $packageName => $package) {
            /** @var \Composer\Package\PackageInterface[] $foundPackages */
            $foundPackages = $repositoryManager->findPackages($packageName, '*');

            $packageVersions = array();
            foreach ($foundPackages as $foundPackage) {
                // skip branches
                if (strpos($foundPackage->getPrettyVersion(), 'dev-') === 0) {
                    continue;
                }

                // skip dev versions
                if ($preferStable && strpos($foundPackage->getPrettyVersion(), '-dev') !== false) {
                    continue;
                }

                $packageVersions[] = $foundPackage->getPrettyVersion();
            }

            $packageVersions = Semver::sort($packageVersions);
            $versions[$packageName] = array_pop($packageVersions);
        }

        return $versions;
    }

    /**
     * Return array of packages indexed with their name
     *
     * @param \Composer\Repository\RepositoryInterface $repository
     * @return \Composer\Package\PackageInterface[]
     */
    private static function getIndexedPackageArray($repository)
    {
        $packages = array();
        foreach ($repository->getPackages() as $package) {
            $packages[$package->getPrettyName()] = $package;
        }

        return $packages;
    }



    public static function getAvailableUpdates(){

    }

    public static function dump() {

        $composer_file = PATH_BASE . '/composer.json';
        if (file_exists($composer_file)) {
            $composer_json = json_decode(file_get_contents($composer_file), true);
            return $composer_json['require'];
        } else {
            return array();
        }

    }

    public static function getComposer(){

        putenv('COMPOSER_HOME=' . PATH_VENDOR . '/bin/composer');
        chdir( PATH_BASE );

        $io =  new BufferIO('', OutputInterface::VERBOSITY_VERY_VERBOSE, new HtmlOutputFormatter(Factory::createAdditionalStyles()));
        $composer_file = PATH_BASE . '/composer.json';

        $composer = Factory::create($io, $composer_file);


        return $composer;
    }

    public static function getInstalledPackages(){

        $composer = static::getComposer();

        //$preferStable = $composer->getPackage()->getPreferStable();

        // Load installed packages
        $repositoryManager = $composer->getRepositoryManager();
        $installedPackages = static::getIndexedPackageArray($repositoryManager->getLocalRepository());

        //@TODO now compare version to see if newer exist.
        //https://github.com/freezy-sk/composer/blob/3771-command-outdated/src/Composer/Command/OutdatedCommand.php
        //$latestVersions = static::getLatestVersions($repositoryManager, $installedPackages, $preferStable);
        //print_R($latestVersions); die;

        $definition = [];


        foreach($installedPackages as $package){

            $definition[] = [
                "name"=>$package->getPrettyName(),
                "version"=>$package->getPrettyVersion(),
                "date"=>$package->getReleaseDate(),
                "string"=>$package->getType()
            ];

        }

        return $definition;

    }

    public static function autoload() {

        $autoload_file = PATH_BASE . '/' . self::VENDOR_DIR . '/autoload.php';
        if (file_exists($autoload_file)) {
            require $autoload_file;
        }
    }



    protected static function createComposerJson($packages) {

        $composer_json = str_replace("\/", '/', json_encode(array(
            'config' => array('vendor-dir' => self::VENDOR_DIR),
            'require' => $packages,
            //
            // TODO:
            // windowsazure requires PEAR repository
            //
            'repositories' => array(array(
                'type' => 'pear',
                'url' => 'http://pear.php.net'
            )),
            'preferred-install' => 'dist'
        )));
        return file_put_contents(PATH_BASE . 'composer.json', $composer_json);
    }

}