<?php
/*
|------------------------------------------------------------
|   o--o  o   o o-o   o  o o-o-o o-o-o
|   |   | |   | |  \  | /    |     |
|   o--o  |   | |   o oo     |     |
|   |   | |   | |  /  | \    |     |
|   o--o   o-o  o-o   o  o o-o-o   o  0.0.9
|
|-------------------------------------------------------------
| A small yet powerful framework for building monstrous apps
|--------------------------------------------------------------
*/

//die;

/*
|---------------------------------------------------------------
| PHP ERROR REPORTING LEVEL
|---------------------------------------------------------------
|
| By default error reporting is set to ALL.  For security
| reasons you are encouraged to change this when your site goes live.
| For more info visit:  http://www.php.net/error_reporting. E Strict became
| Part of E_ALL as of PHP 5.4.0 so use E_ALL except strict standards
|
*/

//check your environment and then decide what level of reporting you need;

//error_reporting( E_ERROR | E_WARNING | E_PARSE | E_NOTICE );
//xdebug_stop_code_coverage();

/*
|-------------------------------------------------------------
| Define Application Paths and include the Framework
|-------------------------------------------------------------
|
| The $path var must include the following keys, needed by the framework
| boostrap:
|
| base:      Which points to the install root
| public:    Which points to the server root or wherever you put this index.php file
| app:       The directory which holds all your application classes and config vars
| storage:   A directory used as a file store.
| vendor:    Pointing to the vendor directory
| framework: The framework directory
|
*/

$paths   = require __DIR__ . '/../paths.php';

$bs      = '/Budkit/Application/Utilities/bootstrap.php';

$app     = require $paths['framework'] . $bs;


/*
|--------------------------------------------------------------
| Use the composer loader class to define system app classes
|--------------------------------------------------------------
|
| The composer auto-load class can be used to add lookup directories for
| custom application classes. This class can be assessed from the app
| controller using $app->loader.
| Alternatively you may use Budkit/Utitlity/Loader
|
*/
$app->loader->add('', $paths['app'].'/controllers');
$app->loader->add('', $paths['app'].'/models');
$app->loader->add('', $paths['app']);


/*
|                     (((
|                    (o o)
| ---------------ooO--(_)--Ooo---------------------------------
| BOOTING...Execute the application
|--------------------------------------------------------------
|
| Starts the application, Parses the request, Processes the Route to the
| Requested Action and Creates a Response which by default is auto-returned.
|
*/
$app->execute();
