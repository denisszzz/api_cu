<?php

namespace Api\Repository;

use Api\Model\Rubric;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

/**
 * Repository.
 */
class RubricsRepository extends DocumentRepository
{

    private $connection;

    public function __construct(DocumentManager $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection, $this->connection->getUnitOfWork(), $this->connection->getClassMetadata(Rubric::class));
    }
}