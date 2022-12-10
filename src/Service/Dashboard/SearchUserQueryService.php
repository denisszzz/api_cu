<?php

namespace Api\Service\Dashboard;


use Api\Helper\FuncHelpers;
use Api\Model\SearchQuery;
use Api\Repository\Dashboard\SearchQueryRepository;
use App\Service\FilteredQueryBuilder;
use Api\Doctrine\Filter\DoctrineFilter;

use function Psl\Type\int;

/**
 * Service.
 */
class SearchUserQueryService
{
    private SearchQueryRepository $searchQueryRepository;

    public function __construct(SearchQueryRepository $searchQueryRepository)
    {
        $this->searchQueryRepository = $searchQueryRepository;
    }

    public function getAll($options=false)
    {
        $all = $this->searchQueryRepository->createQueryBuilder();
        $fields = [
            SearchQuery::class => ['id' => 'id', 'timestamp' => 'timestamp']
        ];

        $filter = new DoctrineFilter($all, $fields, SearchQuery::class);
        $filter->applyFromArray($options);

        $data = $all->getQuery()->execute();

        foreach ($data as $like) {
            $arrayData[] = $like->toArray();
        }

//        foreach ($arrayData as $search) {
//            $query = trim(mb_strtolower($search["query"]));
//            $arrayQuery[$query]["time"][] = $search["timestamp"];
//            $arrayQuery[$query]["total"][] = $search["total"];
//            if ($search["clicks"][0]!==null) {
//                $arrayQuery[$query]["clicks"][] = count($search["clicks"][0]);
//            }else{
//                $arrayQuery[$query]["clicks"][] = 0;
//            }
//        }

        $arrayQuery = [];
        foreach ($arrayData as $search) {
            $query = trim(mb_strtolower($search["query"]));
            if (!isset($arrayQuery[$query])){
                $arrayQuery[$query]["time"] = 1;
                $arrayQuery[$query]["total"] = $search["total"];
                $arrayQuery[$query]["clicks"] = 1;
                if ($search["clicks"][0]!==null) {
                    $arrayQuery[$query]["clicks"] = count($search["clicks"][0]);
                }else{
                    $arrayQuery[$query]["clicks"] = 0;
                }
            }else{
                $arrayQuery[$query]["time"] += 1;
                $arrayQuery[$query]["total"] = $search["total"];
                if ($search["clicks"][0]!==null) {
                    $arrayQuery[$query]["clicks"] += count($search["clicks"][0]);
                }else{
                    $arrayQuery[$query]["clicks"] += 0;
                }
            }
        }

        uasort($arrayQuery, function($a,$b){
            if($a['time']==$b['time']) return 0;
            return $a['time'] < $b['time']?1:-1;
        });

        var_dump($arrayQuery);

        //return $arrayData;
    }

    public function getMust($options)
    {
        if (!isset($options["timestamp"])) return false;

        $all = $this->searchQueryRepository->getAllPostLiked($options["timestamp"]["gte"],$options["timestamp"]["lte"]);

        foreach ($all as $like) {
            $dataLikes[] = $like;
        }

        foreach ($dataLikes as &$dataLike) {
            $countDislikes = ($dataLike["count"] - $dataLike["countLikes"]);
            $dataLike["countDislikes"] = $countDislikes;
        }

        var_dump($dataLikes);
        return $dataLikes;
    }

    public function createEntityJsonResponse($queryBuilder, $options)
    {
//        $fields = [
//            Likes::class => ['id' => 'id', 'timestamp' => 'timestamp']
//        ];
//
//        $filter = new DoctrineFilter($queryBuilder, $fields);
//
//        $filter->applyFromArray($options);
        //var_dump($filter);

        //return true;
    }

}