<?php

namespace App\Middleware;

use Slim\Interfaces\RouterInterface;

class RedirectIfUnauthenticated
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function __invoke($request, $response, $next)
    {
        if (!isset($_SESSION['user_id'])) {
            $response = $response->withRedirect($this->router->pathFor('login'));
        }

        return $next($request, $response);
    }
}