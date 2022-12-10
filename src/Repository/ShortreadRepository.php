<?php

namespace Api\Repository;

use Api\Model\SearchResult;
use Api\Model\Shortread;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

/**
 * Repository.
 */
class ShortreadRepository extends DocumentRepository
{

    private $connection;

    public function __construct(DocumentManager $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection, $this->connection->getUnitOfWork(), $this->connection->getClassMetadata(Shortread::class));
    }

    public function search($query) {
        $builder = $this->createAggregationBuilder();
        $builder->hydrate(SearchResult::class);
        $builder->match()->field('$text')->equals(['$search' => $query])->field('status')->equals('Published');

        $builder
            ->project()
            ->includeFields([
                'title',
                'published',
                'cover',
                'rubric',
                'tags',
                'status',
                '_created',
                'author_name',
                'views',
                'author',
                'disableComments',
                'views_min',
                'title_slug',
                '_createdLabel'
            ])
            ->field('score')
            ->meta('textScore');
        $builder
            ->match()
            ->field('score');
        $builder->sort(['score'=>-1]);

        return $builder->getAggregation();
    }

    public function searchByTag($tag) {
        $builder = $this->createAggregationBuilder();
        $builder->hydrate(SearchResult::class);
        $builder->match()->field('tags')->equals("{$tag}")->field('status')->equals('Published');;

        $builder
            ->project()
            ->includeFields([
                'title',
                'published',
                'cover',
                'rubric',
                'tags',
                'status',
                '_created',
                'author_name',
                'views',
                'author',
                'disableComments',
                'views_min',
                'title_slug'
            ]);
        $builder->sort(['_created'=>-1]);

        return $builder->getAggregation();
    }
}