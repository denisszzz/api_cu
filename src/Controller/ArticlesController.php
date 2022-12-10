<?php

namespace Api\Controller;

use Api\Service\ArticlesService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Api\Repository\LongreadRepository;

class ArticlesController
{
    private ArticlesService $articlesService;

    public function __construct(ArticlesService $articlesService)
    {
        $this->articlesService = $articlesService;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $articles = $this->articlesService->getArticle($request->getAttribute('slug'));
        $response->getBody()->write(json_encode($articles));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
