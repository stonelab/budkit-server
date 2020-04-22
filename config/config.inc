<?php

return [

    "setup" => [
        /*
    |---------------------------------------------------------------
    | Database and other server Settings
    |---------------------------------------------------------------
    |
    | The Default database settings. Please not that these settings
    | will be overriden by config/setup.ini after installation.
    |
    */

        'database' =>
            [
                "host" => "localhost",
                "user" => "root",
                "password" => "",
                "name" => "networkapp",
                "driver" => "SQL",
                "prefix" => "dd_",
                "installed" => false,
                "collate" => "",
                "charset" => "utf-8",
                "select" => true
            ],

        /*
        |---------------------------------------------------------------
        | SESSION SETTINGS
        |---------------------------------------------------------------
        |
        | By default error reporting is set to ALL.  For security
        | reasons you are encouraged to change this when your site goes live.
        | For more info visit:  http://www.php.net/error_reporting. E Strict became
        | Part of E_ALL as of PHP 5.4.0 so use E_ALL except strict standards
        |
        */

        'session' =>
            [
                'store' => 'file', //change to database to use database as session handler
                'table' => '?session',
                'cookie' => 'psession',
                'domain' => 'budkit',
                'path' => '/',
                'datafile' => '/',//The absolute path to the session data file store
                'life' => 60 * 15 * 4, //15 minutes The amount of time to keep for,
                'folder' => PATH_STORAGE . DIRECTORY_SEPARATOR . 'sessions',
                //Time to session remberance
                //If no explicit expiry time is set, session will be remembered for this long
                'remember' => 60 * 60 * 24 * 14 //14 day
            ],


        /*
    |---------------------------------------------------------------
    | ENCRYPTION KEY DUMMY
    |---------------------------------------------------------------
    |
    | By default error reporting is set to ALL.  For security
    | reasons you are encouraged to change this when your site goes live.
    | For more info visit:  http://www.php.net/error_reporting. E Strict became
    | Part of E_ALL as of PHP 5.4.0 so use E_ALL except strict standards
    |
    */
        'encrypt' => [
            'key' => 'awesome-secret'
        ],

        /*
|---------------------------------------------------------------
| ENVIRONMENT SETTINGS
|---------------------------------------------------------------
|
| By default error reporting is set to ALL.  For security
| reasons you are encouraged to change this when your site goes live.
| For more info visit:  http://www.php.net/error_reporting. E Strict became
| Part of E_ALL as of PHP 5.4.0 so use E_ALL except strict standards
|
*/
        'environment' =>
            [
                'mode' => 0, //0 = DEVELOPER, 1 = TEST, 2 = PRODUCTION
                'configdir' => __DIR__
            ],


        /*
        |---------------------------------------------------------------
        | SYSTEM & DEFAULT CONFIGURATION SETTINGS
        |---------------------------------------------------------------
        |
        | The system config key can be overloaded with data from the database.
        | but for now to test things i am just going to use it on file
        */
        'site' =>
            [
                'host' => 'localhost/',
                'path' => '/',
                'name' => 'BudKit',
                'meta-description' => 'The collaborative, distributed, social web platform',
                'meta-keywords' => 'social, network, professional',
                'registration' => 1,
                'inviteonly' => 0,
                'verify-email' => 0,
                'page-title' => 'name-first',
                'robots' => 'index-no-follow',
                'url-suffix' => 1,
                'unicode-aliases' => 0,
                'public-authority' => 1,
                'default-authority' => 2, //@TODO Should we set this after DB install?
                'superadmin-authority' => 4 //This settings can only be set on file, as could affect existing users
            ],

    ],
    'server' =>
        [
            'mail' => [
                'outgoing-handler' => 'smtp',
                'outgoing-address' => 'outmail@budkit.org',
                'outgoing-server' => 'http://webmail.budkit.org',
                'outgoing-server-port' => 25,
                'outgoing-server-security' => 'none',
                'outgoing-server-username' => 'drstonyhills',
                'outgoing-server-password' => '',
            ],
            'proxy' => [
                'server' => '',
                'server-port' => '',
                'server-username' => '',
                'server-password' => '',
            ],
            'api' => [
                'enable-restful' => 1,
                'enable-xmlrpc' => 1,
                'protocol-auth' => 1,
            ],
            'debug' => [
                'error-log' => 'error_log.log',
                'error-console' => 1,
                'error-send' => 1,
                'help-server-address' => 'http://help.budkit.org'
            ]
        ]
];
