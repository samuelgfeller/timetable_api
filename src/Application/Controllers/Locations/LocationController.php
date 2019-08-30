<?php
namespace App\Controllers\Locations;

use App\Controllers\Controller;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use function DI\value;

class LocationController extends Controller
{
    // constructor container
/*        protected $container;

      public function __construct(ContainerInterface $container) {
          var_dump($container->get('logger'));
          $this->container = $container;
       }*/
 
    // Test request
    /*    public function testRequest() {
        echo 'went into action from location controller';
        $response = $this->response->getBody()->write('GET request');
        return $response;
    }*/

    public function get(Request $request, Response $response, array $args) {
        $id = $args['id'];
//        var_dump($this->container->get('logger'));
        $response->getBody()->write('GET request');
        $this->logger->info('locations/'.$id.' has been called');
//        var_dump($this->logger);
        return $response;
    }
    public function update(Request $request, Response $response, array $args) {
        $response->getBody()->write('PUT request');
        return $response;
    }
    
    public function delete(Request $request, Response $response, array $args) {
         $response->getBody()->write('DELETE request');
        return $response;
    }
    
    public function create(Request $request, Response $response, array $args) {
        $response->getBody()->write('POST request');
        return $response;
    }
    public function list(Request $request, Response $response, array $args) {
        $response->getBody()->write('GET List');
        return $response;
    }

    
}
