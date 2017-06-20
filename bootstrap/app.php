<?php

session_start();
//$_SESSION['user_id'] = 1;
unset($_SESSION['user_id']);

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$container = $app->getContainer();

$container['db'] = function () {
    return new PDO('mysql:host=localhost;dbname=slim', 'root', '');
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$container['notFoundHandler'] = function ($c) {
    return new App\Handlers\NotFoundHandler($c['view']);
};

// Web routes
require __DIR__ . '/../routes/wep.php';

// API routes
require __DIR__ . '/../routes/api.php';