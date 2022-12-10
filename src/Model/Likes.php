<?php

namespace Api\Model;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="_likes")
 */
class Likes
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $titlePost;

    /** @ODM\Field(type="string") */
    private $idPost;

    /** @ODM\Field(type="string") */
    private $collectionPost;

    /** @ODM\Field(type="string") */
    private $sid;

    /** @ODM\Field(type="string") */
    private $userId;

    /** @ODM\Field(type="int") */
    private $itemSave;

    /** @ODM\Field(type="string") */
    private $timestamp;


    public function toArray(array $params = []): array
    {
        return [
            "id" => $this->id,
            "idPost" => $this->getIdPost(),
            "titlePost" => $this->getTitlePost(),
            "collectionPost" => $this->getCollectionPost(),
            "sid" => $this->getSid(),
            "userId" => $this->getUserId(),
            "itemSave" => $this->getItemSave(),
            "timestamp" => $this->getTimestamp(),
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    private function getTitlePost()
    {
        return $this->titlePost;
    }

    private function getIdPost()
    {
        return $this->idPost;
    }

    private function getCollectionPost()
    {
        return $this->collectionPost;
    }

    private function getSid()
    {
        return $this->sid;
    }

    private function getUserId()
    {
        return $this->userId;
    }

    private function getTimestamp()
    {
        return $this->timestamp;
    }

    private function getItemSave()
    {
        return $this->itemSave;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setTitlePost($value)
    {
        $this->titlePost = $value;
    }

    public function setIdPost($value)
    {
        $this->idPost = $value;
    }

    public function setCollectionPost($value)
    {
        $this->collectionPost = $value;
    }

    public function setUserId($value)
    {
        $this->userId = $value;
    }

    public function setSid($value)
    {
        $this->sid = $value;
    }

    public function setTimestamp($value)
    {
        $this->timestamp = $value;
    }

    public function setItemSave($value)
    {
        $this->itemSave = $value;
    }


}