<?php
namespace App\Service;

use Api\Model\Likes;
use Doctrine\DBAL\Query\QueryBuilder;
use Api\Doctrine\Filter\DoctrineFilter;
use Api\Doctrine\Filter\ExposedFieldsReader;
use Doctrine\ODM\MongoDB\Query\Builder;

class FilteredQueryBuilder
{
    public function createEntityJsonResponse($queryBuilder)
    {
//        $fields = [
//            Likes::class => ['id' => 'id', 'name' => 'name']
//        ];

        //$filter = new DoctrineFilter($queryBuilder, $fields);
        //var_dump($filter);

        //$filter->applyFromArray($this->requestStack->getCurrentRequest()->query->all());

        return true;
    }
}