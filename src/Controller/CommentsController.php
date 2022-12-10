<?php

namespace Api\Controller;

use Api\Service\CommentsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Api\Repository\CommentsRepository;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

final class CommentsController
{
    private CommentsService $commentsService;

    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $postId = (string)$request->getAttribute('id');

        if (!$postId) {
            throw new \Exception('Не указан id поста');
        }

        $comments = $this->commentsService->getComments($postId);
        if (!$comments) {
            throw new HttpNotFoundException($request);
        }

        $response->getBody()->write(json_encode($comments));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
