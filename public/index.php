<?php
try {
    // Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
        '../app/forms/',
        '../app/customhelpers' // Add the new helpers folder
    ))->register();

    // Create a DI
    $di = new Phalcon\DI\FactoryDefault();

    // Assign our new tag a definition so we can call it
    $di->set('FormatDate', function() {
        return new FormatDate();
    });

    // Set the view cache service
    $di->set('viewCache', function() {
        // Cache data for one day by default
        $frontCache = new \Phalcon\Cache\Frontend\Data(array(
            "lifetime" => 86400
        ));
        $cache = new \Phalcon\Cache\Backend\File($frontCache, array(
            "cacheDir" => "../app/cache/",
            "prefix" => "view-data-"
        ));
        return $cache;
    });

    // Set the view cache service
    $di->set('modelsCache', function() {
        // Cache data for one day by default
        $frontCache = new \Phalcon\Cache\Frontend\Data(array(
            "lifetime" => 86400
        ));
        $cache = new \Phalcon\Cache\Backend\File($frontCache, array(
            "cacheDir" => "../app/cache/",
            "prefix" => "talks-data-"
        ));
        return $cache;
    });


    //Setup the database service
    $di->set('db', function(){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "localhost",
            "username" => "phalconappuser",
            "password" => "phalconappuser",
            "dbname" => "phalconapp"
        ));
    });

    // Setup the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    // Setup a base URI so that all generated URIs include the "tutorial" folder
    $di->set('url', function(){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/');
        return $url;
    });

    // Create the router
    $router = new \Phalcon\Mvc\Router();
    //Add a route to the group
    $router->add('/talks/edit/{id}', array(
        "controller" => "talks",
        "action" => 'edit',
    ))->setName('talks-edit')->getHttpMethods(array('GET', 'POST'));

    $router->addGet('/talks/add', array(
        "controller" => "talks",
        "action" => 'add',
    ))->setName('talks-add');

    //Set 404 paths
    $router->notFound(array(
        "controller" => "index",
        "action" => "route404"
    ));

    $router->removeExtraSlashes(true);

    /**
     * add routing capabilities
     */
    $di->set('router', $router);

    // Handle the request
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
    echo "PhalconException: ", $e->getMessage();
}