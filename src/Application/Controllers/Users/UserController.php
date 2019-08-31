<?php

namespace App\Controllers\Locations;

use App\Application\Controllers\Controller;
use App\Domain\User\UserRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

class UserController extends Controller {
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepositoryInterface;

    public function __construct(LoggerInterface $logger, UserRepositoryInterface $userRepositoryInterface) {
        parent::__construct($logger);
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function get(Request $request, Response $response, array $args) {
        $id = $args['id'];
//        var_dump($this->container->get('logger'));
        $response->getBody()->write('GET request');
        $this->logger->info('locations/' . $id . ' has been called');
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
        $allUsers = $this->userRepositoryInterface->findAllUsers();

        //somehow that doesnt work
//        $this->respondWithData($response, $allUsers);
        //    $this->respondWithDataPrettyJson($response, $allUsers);


        // This works though
         $response->getBody()->write(json_encode($allUsers));
        return $response->withHeader('Content-Type', 'application/json');

    }


}
