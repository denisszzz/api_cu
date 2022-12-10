<?php

namespace Api\Repository\Dashboard;

use Api\Model\Likes;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

/**
 * Repository.
 */
class LikeRepository extends DocumentRepository
{

    private $connection;

    public function __construct(DocumentManager $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection, $this->connection->getUnitOfWork(), $this->connection->getClassMetadata(Likes::class));
    }

    public function getAllPostLiked($timestampStart, $timestampEnd)
    {

        $builder = $this->dm->createAggregationBuilder(Likes::class);
        //$builder = $this->dm->createQueryBuilder(Likes::class);

        $group_expression = $builder->expr()
            ->field('idPost')
            ->expression('$idPost');

        $builder
        ->match()
            ->field('timestamp')
            ->gte($timestampStart)
            ->lt($timestampEnd)
        ->group()
            ->field('_id')
            ->expression($group_expression)
            ->field('titlePost')
            ->last('$titlePost')
//            ->field('user')
//            ->push('$userId')
//            ->field('sid')
//            ->push('$sid')
//            ->field('time')
//            ->push('$timestamp')
            ->field('count')
            ->sum(1)
            ->field('countLikes')
            ->sum('$itemSave')
        ->sort(['countLikes' => -1]);

        return $builder->getAggregation();
    }


    public function getPostLiked($filter)
    {

        $builder = $this->dm->createAggregationBuilder(Likes::class);
        $builder = $this->dm->createQueryBuilder();

        $group_expression = $builder->expr()
            ->field('idPost')
            ->expression('$idPost');

        $builder
            ->match()
            ->field('timestamp')
            ->gte("2022-11-04")
            ->lt("2022-11-05")
            ->group()
            ->field('_id')
            ->expression($group_expression)
            ->field('titlePost')
            ->last('$titlePost')
            ->field('user')
            ->push('$userId')
            ->field('sid')
            ->push('$sid')
            ->field('time')
            ->push('$timestamp')
            ->field('count')
            ->sum(1)
            ->field('countLikes')
            ->sum('$itemSave')
            ->sort(['countLikes' => -1]);

        return $builder->getAggregation();
    }
}