<?php

namespace Api\Service;


use Api\Repository\CommentsRepository;
use Api\Repository\UserRepository;

/**
 * Service.
 */
class CommentsService
{
    /**
     * @var CommentsRepository
     */
    private $repository;
    private UserRepository $userRepository;

    /**
     * The constructor.
     *
     * @param CommentsRepository $repository The repository
     * @param UserRepository $userRepository The repository
     */
    public function __construct(CommentsRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $postId id поста к которому привязаны комментарии
     * @return array
     */
    public function getComments(string $postId): array
    {
        $comments = $this->repository->findBy(["source._id"=>$postId]);
        $arrayComments = [];
        foreach ($comments as $comment) {
            $arrayComments[] = $comment->toArray();
        }
        return $arrayComments;
    }
}