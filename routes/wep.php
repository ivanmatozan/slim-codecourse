<?php

use App\Controllers\TopicController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Middleware\RedirectIfUnauthenticated;
use App\Middleware\IpFilter;

//$app->add(new IpFilter($container['db']));

$app->group('/', function () {
    $this->get('', HomeController::class . ':index');
});

$app->group('/topics', function () use ($container) {
    $this->get('', TopicController::class . ':index');
    $this->get('/middle', TopicController::class . ':middle');
});

$app->group('', function () {
    $this->get('/topics/create', TopicController::class . ':create')->setName('topics.create');
    $this->get('/topics/{id}', TopicController::class . ':show')->setName('topics.show');
})->add(new RedirectIfUnauthenticated($container['router']));

$app->group('/users', function () {
    $this->get('', UserController::class . ':index');
    $this->get('/login', UserController::class . ':login')->setName('login');
});