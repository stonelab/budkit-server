<?php
/*
|------------------------------------------------------------
|   o--o  o   o o-o   o  o o-o-o o-o-o
|   |   | |   | |  \  | /    |     |
|   o--o  |   | |   o oo     |     |
|   |   | |   | |  /  | \    |     |
|   o--o   o-o  o-o   o  o o-o-o   o  ALPHA
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
//error_reporting( E_ERROR | E_WARNING | E_PARSE | E_NOTICE );
//xdebug_stop_code_coverage();

/*
|---------------------------------------------------------------
| DEFINE APPLICATION PATHS
|---------------------------------------------------------------
|
| EXT		- The file extension.  Typically ".php"
| SELF		- The name of THIS file (typically "index.php")
| FSPATH	- The full server path to THIS file
| APPPATH	- The full server path to the "application" folder
| DS            - The directory seperator constant
|
*/

$paths 		= require __DIR__.'/paths.php';
$uri 		= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri 		= urldecode($uri);

$requested 	= $paths['public'].$uri;

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' and file_exists($requested))
{
    return false;
}

/*
|                     (((
|                    (o o)
| ---------------ooO--(_)--Ooo---------------------------------
| BOOTING...
|---------------------------------------------------------------
|
| Fireaway
|
*/
require_once $paths['public'].'/index.php';