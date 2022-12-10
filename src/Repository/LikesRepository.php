<?php

namespace Api\Repository;

use Api\Model\Likes;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

/**
 * Repository.
 */
class LikesRepository extends DocumentRepository
{

    private $connection;

    public function __construct(DocumentManager $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection, $this->connection->getUnitOfWork(), $this->connection->getClassMetadata(Likes::class));
    }

    public function insert(Likes $model)
    {
        $this->dm->persist($model);
        $this->dm->flush();
        return $model->getId();
    }

    public function updateItemSave($id, $itemSave)
    {
        return $this->dm->createQueryBuilder(Likes::class)
            ->findAndUpdate()
            ->field('id')->equals($id)
            ->field('itemSave')->set($itemSave)
            ->getQuery()
            ->execute();
    }
}