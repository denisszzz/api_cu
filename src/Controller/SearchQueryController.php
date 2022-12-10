<?php

namespace Api\Controller;

use Api\Service\SearchQueryService;
use Api\Service\SearchService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class SearchQueryController
{
    private SearchQueryService $searchQueryService;

    public function __construct(SearchQueryService $searchQueryService)
    {
        $this->searchQueryService = $searchQueryService;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $input = (array)$request->getParsedBody();
        if (!isset($input["query"]) || !isset($input["total"])) return $response->withStatus(400, "query and total required");

        $searchQueryId = $this->searchQueryService->insert($input);
        $response->getBody()->write(json_encode($searchQueryId));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
