<?php

namespace Api\Controller;

use Api\Service\SearchService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class SearchController
{
    private SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getQueryParams();
        $articles = $this->searchService->search($request->getAttribute('query'), $params);
        $response->getBody()->write(json_encode($articles));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
