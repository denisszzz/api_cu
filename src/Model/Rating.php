<?php
namespace Api\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Api\Repository\RatingRepository;

/**
 * @ODM\Document(collection="collections_ratings5f86d71762f5b", repositoryClass="Backend\Repository\RatingRepository")
 */
class Rating
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $icon;

    /** @ODM\Field(type="string") */
    private $title;

    /** @ODM\Field(type="string") */
    private $counter;

    /** @ODM\Field(type="string") */
    private $color;


    public function toArray(array $params = []): array
    {
        return [
            "id" => $this->id,
            "icon" => $this->getIcon(),
            "title" => $this->getTitle(),
            "counter" => $this->getCounter(),
            "color" => $this->getColor(),
        ];
    }

    private function getIcon()
    {
        return $this->icon;
    }

    private function getTitle()
    {
        return $this->title;
    }

    private function getCounter()
    {
        return $this->counter;
    }

    private function getColor()
    {
        return $this->color;
    }

}