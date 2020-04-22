<?php

namespace Helper;

use Composer\Script\Event;

class Packages{



    /**
     * Before a package is installed
     *
     * @param Event $event
     */
    public static function prePackageInstall(Event $event){

        //Get an instance of the app
        //$app = new Instance();

    }

    /**
     * After a package is installed
     *
     * @param Event $event
     */
    public static function postPackageInstall(Event $event){}

    /**
     * Before a package is installed
     *
     * @param Event $event
     */
    public static function prePackageUnInstall(Event $event){}

    /**
     * After a package is installed
     *
     * @param Event $event
     */
    public static function postPackageUnInstall(Event $event){}

    /**
     * Before a package is installed
     *
     * @param Event $event
     */
    public static function prePackageUpdate(Event $event){

 //       $io = $event->getIO();
//        if ($io->askConfirmation("Are you sure you want to proceed? ", false)) {
//            // ok, continue on to composer install
//            return true;
//        }
//        // exit composer and terminate installation process
//        exit;


    }

    /**
     * After a package is installed
     *
     * @param Event $event
     */
    public static function postPackageUpdate(Event $event){}


}