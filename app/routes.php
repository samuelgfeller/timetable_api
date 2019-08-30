<?php

//use App\Controllers\Locations\LocationController;
use App\Controllers\Locations\LocationController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response, array $args) {
//	var_dump($response);
        $response->getBody()->write(json_encode($response->getStatusCode()));

        return $response;
    });

    $app->group('/locations', function (RouteCollectorProxy $group)  {
        $group->get('/{id:[0-9]+}', LocationController::class.':get');
        
        $group->get('/test', function (Request $request, Response $response, array $args) {
//	var_dump($response);
            $response->getBody()->write(json_encode($response->getStatusCode()));

            return $response;
        });
        $group->put('/{id:[0-9]+}', LocationController::class.':update');
        $group->delete('/{id:[0-9]+}', LocationController::class.':delete');

        $group->post('', LocationController::class.':create');
        $group->get('', LocationController::class.':list');
    });

 
 
    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");

        return $response;
    });
};
