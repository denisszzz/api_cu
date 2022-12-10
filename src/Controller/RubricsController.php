<?php

namespace Api\Controller;

use Api\Service\ArticlesService;
use Api\Service\RubricsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Api\Repository\LongreadRepository;

class RubricsController
{
    private RubricsService $rubricsService;

    public function __construct(RubricsService $rubricsService)
    {
        $this->rubricsService = $rubricsService;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $slug = $request->getAttribute('slug');
        if ($slug!=""){
            $articles = $this->rubricsService->getRubric($slug);
        }else{
            $articles = $this->rubricsService->getRubric();
        }
        $response->getBody()->write(json_encode($articles));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
