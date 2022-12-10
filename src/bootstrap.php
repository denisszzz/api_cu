<?php
require $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
use DI\ContainerBuilder;
use Slim\App;
use Manticoresearch\Client;
@ini_set('session.cookie_secure','On');


$containerBuilder = new ContainerBuilder();

// Set up settings
$containerBuilder->addDefinitions($_SERVER["DOCUMENT_ROOT"] . '/src/container.php');

// Build PHP-DI Container instance
$container = $containerBuilder->build();


// Create App instance
$app = $container->get(App::class);



// Register routes
(require $_SERVER["DOCUMENT_ROOT"] . '/src/routes.php')($app);

// Register middleware
(require $_SERVER["DOCUMENT_ROOT"] . '/src/middleware.php')($app);

(require $_SERVER["DOCUMENT_ROOT"] . '/src/searchBootstrap.php');

//$configSearch = ['host'=>'127.0.0.1','port'=>9308];
//$clientSearch = new Client($configSearch);
//$indexSearch = $clientSearch->index('movies');


return $app;