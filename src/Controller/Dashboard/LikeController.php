<?php

namespace Api\Controller\Dashboard;

use Api\Service\Dashboard\LikeService;
use Api\Service\SearchQueryService;
use Api\Service\SearchService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Slim\Exception\HttpNotFoundException;

class LikeController
{
    private LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function getAll(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $options = (array)$request->getQueryParams();


        $likes = $this->likeService->getAll($options);

        $response->getBody()->write(json_encode($likes));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function getMust(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $options = (array)$request->getQueryParams();


        $likes = $this->likeService->getMust($options);

        $response->getBody()->write(json_encode($likes));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
