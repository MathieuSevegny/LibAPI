<?php

use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\TwigMiddleware;


return function (App $app) {
    $app->add(\App\Midleware\BeforeEditingMidd::class);
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Ajouter cette ligne
    $app->add(TwigMiddleware::class);

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Add app base path
    $app->add(BasePathMiddleware::class);

    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);


};
