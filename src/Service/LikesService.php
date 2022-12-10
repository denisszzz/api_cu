<?php

namespace Api\Service;


use Api\Helper\FuncHelpers;
use Api\Model\Likes;
use Api\Repository\LikesRepository;

/**
 * Service.
 */
class LikesService
{
    private LikesRepository $likesRepository;

    public function __construct(LikesRepository $likesRepository)
    {
        $this->likesRepository = $likesRepository;
    }

    /**
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Doctrine\ODM\MongoDB\LockException
     */
    public function insert($input)
    {
        $isLikeUser = self::get($input["postId"], $input["sid"]??'' ,$input["userId"]??'');


        if (is_array($isLikeUser) && isset($isLikeUser["id"])){
            $likeId = $this->likesRepository->updateItemSave($isLikeUser["id"], $input["itemSave"]);
        }else {
            $saveLike = new Likes();
            $saveLike->setItemSave($input['itemSave']);
            $saveLike->setIdPost($input['postId']);
            $saveLike->setTimestamp((new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s'));
            $saveLike->setCollectionPost($input['collection']);
            $saveLike->setTitlePost($input['titlePost']);
            $saveLike->setUserId($input['userId']??'');
            $saveLike->setSid($input['sid']??'');
            $likeId = $this->likesRepository->insert($saveLike);
        }
        return $likeId;
    }

    public function get($idPost, $sid = '', $userId = '')
    {
        $likes = [];
        if ($userId!=""){
            $likes = $this->likesRepository->findBy(['idPost'=>$idPost, 'userId'=>$userId])??[];
        }elseif ($sid!=""){
            $likes = $this->likesRepository->findBy(['idPost'=>$idPost, 'sid'=>$sid])??[];
        }elseif ($userId!="" && $sid!=""){
            $likes = $this->likesRepository->findBy(['idPost'=>$idPost, 'userId'=>$sid])??[];
        }
        $dataLikes = [];

        foreach ($likes as $like) {
            $dataLikes = $like->toArray();
        }

        return $dataLikes;
    }
}