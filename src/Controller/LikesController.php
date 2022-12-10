<?php

namespace Api\Controller;

use Api\Service\LikesService;
use Api\Service\SearchQueryService;
use Api\Service\SearchService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Slim\Exception\HttpNotFoundException;

class LikesController
{
    private LikesService $likesService;

    public function __construct(LikesService $likesService)
    {
        $this->likesService = $likesService;
    }

    /**
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Doctrine\ODM\MongoDB\LockException
     */
    public function set(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $input = (array)$request->getParsedBody();
        $input["sid"] = $_COOKIE["sid"]??'';
        if (!isset($input['postId']) || !isset($input['itemSave'])) return $response->withStatus(400, 'id and itemSave required');

        $likesId = $this->likesService->insert($input);
        $response->getBody()->write(json_encode($likesId));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $postId = (string)$request->getAttribute('id');
        $get = (array)$request->getQueryParams();

        if (!$postId) {
            throw new \Exception('Не указан id поста');
        }

        $likes = $this->likesService->get($postId, $_COOKIE["sid"]??'', $get['userId']??'');

        $response->getBody()->write(json_encode($likes));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
