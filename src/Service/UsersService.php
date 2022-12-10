<?php

namespace Api\Service;

use Api\Repository\UsersRepository;

/**
 * Service.
 */
class UsersService
{
    /**
     * @var UsersRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UsersRepository $repository The repository
     */
    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUser($id)
    {
        $users = $this->repository->findBy(["id"=>$id]);
        $dataUser = [];
        foreach ($users as $user) {
            $dataUser = $user->toArray();
        }
        return $dataUser;
    }
}