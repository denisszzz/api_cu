<?php

use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();


    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);

};