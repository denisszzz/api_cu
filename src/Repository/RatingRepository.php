<?php

namespace Api\Repository;

use Api\Model\Rating;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

/**
 * Repository.
 */
class RatingRepository extends DocumentRepository
{

    private $connection;

    public function __construct(DocumentManager $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection, $this->connection->getUnitOfWork(), $this->connection->getClassMetadata(Rating::class));
    }
}