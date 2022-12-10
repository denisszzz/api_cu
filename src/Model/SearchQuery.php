<?php

namespace Api\Model;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="collections_search_query5f876542324fae")
 */
class SearchQuery
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $query;

    /** @ODM\Field(type="string") */
    private $total;

    /** @ODM\Field(type="string") */
    private $user_id;

    /** @ODM\Field(type="string") */
    private $sid;

    /** @ODM\Field(type="string") */
    private $timestamp;

    /** @ODM\Field(type="collection") */
    private $clicks;


    public function toArray(array $params = []): array
    {
        return [
            "id" => $this->id,
            "query" => $this->getQuery(),
            "total" => $this->getTotal(),
            "user_id" => $this->getUserId(),
            "sid" => $this->getSid(),
            "timestamp" => $this->getTimestamp(),
            "clicks" => $this->getClicks(),
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    private function getQuery()
    {
        return $this->query;
    }

    private function getTotal()
    {
        return $this->total;
    }

    private function getUserId()
    {
        return $this->user_id;
    }

    private function getSid()
    {
        return $this->sid;
    }

    private function getTimestamp()
    {
        return $this->timestamp;
    }

    private function getClicks()
    {
        return [$this->clicks];
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setQuery($value)
    {
        $this->query = $value;
    }

    public function setTotal($value)
    {
        $this->total = $value;
    }

    public function setUserId($value)
    {
        $this->user_id = $value;
    }

    public function setSid($value)
    {
        $this->sid = $value;
    }

    public function setTimestamp($value)
    {
        $this->timestamp = $value;
    }

    public function setClicks($value)
    {
        $this->clicks = $value;
    }


}