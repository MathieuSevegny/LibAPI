<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    $app->get('/books', \App\Action\ShowBooksAction::class)->setName('allBooks');

    $app->get('/book/id/{id}', \App\Action\ShowABookAction::class)->setName('aBook');

    $app->get('/books/title/{title}', \App\Action\ShowABookTitleAction::class)->setName('aBook');

    $app->post('/users', \App\Action\UserCreateAction::class);

};

