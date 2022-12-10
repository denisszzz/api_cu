<?php

namespace Api\Controller;

use Api\Service\UsersService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class UsersController
{
    private UsersService $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $articles = $this->usersService->getUser($request->getAttribute('id'));
        $response->getBody()->write(json_encode($articles));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
