<?php

use Budkit\Application\Support\Service;
use Budkit\Dependency\Container;

class Provider implements Service
{

    protected $application;

    public function __construct(Container $application)
    {
        $this->application = $application;
    }


    public static function getPackageDir()
    {
    }

    public function onRegister()
    {

        /*
        |---------------------------------------------------------------
        | Default request tokens
        |---------------------------------------------------------------
        |
        | By default the {format} placeholder in a route path will match
        | '(\.[^/]+)?') for things like .html, .json, .xml etc..
        |
        */
        Route::setTokens(
            array('format' => '(\.[^/]+)?')
        );

        Route::attachResource("/extension", "Extensions"); //collection of persons?


        /*
        |---------------------------------------------------------------
        | Platform manager
        |---------------------------------------------------------------
        |
        | By default the {format} placeholder in a route path will match
        | '(\.[^/]+)?') for things like .html, .json, .xml etc..
        |
        */
        Route::attach("/extensions", Controller\Extensions::class, function ($route) {

            //subroutes
            //$route->setAction(Controller\Extensions::class);
            $route->add('{format}', 'index');
            //   $route->add('/{id}{format}', "read");
            //   $route->add('/{id}/edit{format}', "edit");

        });

    }

    public function definition()
    {
        return ["app.register" => "onRegister"];
    }

}