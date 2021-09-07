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

use Budkit\Cms\Helper;

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
| Create a publisher
|--------------------------------------------------------------
|
| The composer auto-load class can be used to add lookup directories for
| custom application classes. This class can be assessed from the app
| controller using $app->loader.
| Alternatively you may use Budkit/Utitlity/Loader
|
*/
$loop   =   React\EventLoop\Factory::create();
$pusher =   new \Thruway\Peer\Client("pubsub", $loop);

$pusher->on('open', function ($session) use ($loop) {

    $context = new React\ZMQ\Context($loop);
    $pull    = $context->getSocket(ZMQ::SOCKET_PULL);

    $pull->bind('tcp://127.0.0.1:5555');
    $pull->on('message', function ($message) use ($session){
        //messages should be sent as encode json?
        $data = json_decode($message, true);



        //must tell us the topic
        if(isset($data["topic"])){
            $session->publish($data["topic"], [ $data ]);
        }
    });
});

$router = new Thruway\Peer\Router($loop);
$authMgr= new \Thruway\Authentication\AuthenticationManager();
//$router->setAuthenticationManager( $authMgr );
//$router->addTransportProvider( new \Thruway\Transport\InternalClientTransportProvider($authMgr));
$router->registerModule( $authMgr );

//maybe register the auth as a module, extend module
$router->addInternalClient( $app->createInstance( Helper\PubsubAuth::class, [$app, ["*"]])  );
$router->addInternalClient( $pusher );
$router->addTransportProvider(new Thruway\Transport\RatchetTransportProvider("0.0.0.0", 8080));

$router->start();
