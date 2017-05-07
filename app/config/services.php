<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as Flash;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    // Disable several levels，取消三级的模板渲染机制，这个将来也是可以利用一下的。
    $view->disableLevel(array(
        View::LEVEL_LAYOUT      => true,
        View::LEVEL_MAIN_LAYOUT => true
    ));
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_',
                'compileAlways'=> $config->application->voltCompileAlways,//修改view的时候用这个

            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->setShared('router',function(){
    return require APP_PATH .'/config/routes.php';
});

$di->setShared('dispatcher',function(){
    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    /** @var \Phalcon\Events\Manager $eventsManager */
    $eventsManager = $this->get('eventsManager');
    $eventsManager->attach('dispatch',$this->get(\core\myDispatcherEventsHandler::class));
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
});

$di->setShared('auth',function(){
    $auth = (new \core\myAuth())->setDI($this)->init();
    return $auth;
});

$di->setShared('crypt',function(){
    $crypt = new \Phalcon\Crypt();
    $crypt->setKey('myCryptKey024018');//需要注意，key的位数，16,24,32，需要注意！
    return $crypt;
});

$di->setShared('eventsManager',function(){
    return require APP_PATH .'/config/events.php';
});
