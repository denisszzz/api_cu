<?php

namespace Api\Controller;

use Api\Service\SearchService;
use Api\Service\TagsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class TagsController
{
    private TagsService $tagsService;

    public function __construct(TagsService $tagsService)
    {
        $this->tagsService = $tagsService;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getQueryParams();
        $articles = $this->tagsService->findTag($request->getAttribute('tag'), $params);
        $response->getBody()->write(json_encode($articles));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
