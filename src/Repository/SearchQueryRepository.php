<?php

namespace Api\Repository;

use Api\Model\SearchQuery;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

/**
 * Repository.
 */
class SearchQueryRepository extends DocumentRepository
{

    private $connection;

    public function __construct(DocumentManager $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection, $this->connection->getUnitOfWork(), $this->connection->getClassMetadata(SearchQuery::class));
    }

    public function insert(SearchQuery $model)
    {
        $this->dm->persist($model);
        $this->dm->flush();
        return $model->getId();
    }

    public function updateTotal($id, $total)
    {
        $this->dm->createQueryBuilder(SearchQuery::class)
            ->findAndUpdate()
            ->field('id')->equals($id)
            ->field('total')->set($total)
            ->getQuery()
            ->execute();
    }
}