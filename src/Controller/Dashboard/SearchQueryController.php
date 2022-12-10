<?php

namespace Api\Controller\Dashboard;

use Api\Service\Dashboard\SearchUserQueryService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Slim\Exception\HttpNotFoundException;

class SearchQueryController
{
    private SearchUserQueryService $searchQueryService;

    public function __construct(SearchUserQueryService $searchQueryService)
    {
        $this->searchQueryService = $searchQueryService;
    }

    public function getAll(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $options = (array)$request->getQueryParams();


        $likes = $this->searchQueryService->getAll($options);

        $response->getBody()->write(json_encode($likes));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function getMust(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $options = (array)$request->getQueryParams();


        $likes = $this->searchQueryService->getMust($options);

        $response->getBody()->write(json_encode($likes));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
