<?php
namespace Illuminates;
use App\Http\Controllers\HomeController;
use Illuminates\Router\Router; // Corrected namespace

class Application
{
    public function start()
    {
        $router = new Router;

        $router->add('GET', '/', HomeController::class, 'index', []);
        $router->add('GET', '/about', HomeController::class, 'about', []);
        $router->add('GET', '/go', HomeController::class, 'go', []);
        $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

    }
}
