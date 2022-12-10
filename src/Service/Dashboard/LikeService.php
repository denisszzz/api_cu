<?php

namespace Api\Service\Dashboard;


use Api\Helper\FuncHelpers;
use Api\Model\Likes;
use Api\Repository\Dashboard\LikeRepository;
use App\Service\FilteredQueryBuilder;
use Api\Doctrine\Filter\DoctrineFilter;

/**
 * Service.
 */
class LikeService
{
    private LikeRepository $likeRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function getAll($options=false)
    {
        $all = $this->likeRepository->createQueryBuilder();
        $fields = [
            Likes::class => ['id' => 'id', 'timestamp' => 'timestamp']
        ];

        $filter = new DoctrineFilter($all, $fields, Likes::class);
        $filter->applyFromArray($options);

        $data = $all->getQuery()->execute();

        foreach ($data as $like) {
            $arrayData[] = $like->toArray();
        }

        return $arrayData;
    }

    public function getMust($options)
    {
        if (!isset($options["timestamp"])) return false;

        $all = $this->likeRepository->getAllPostLiked($options["timestamp"]["gte"],$options["timestamp"]["lte"]);

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