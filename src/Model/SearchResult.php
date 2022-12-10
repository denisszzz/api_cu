<?php

namespace Api\Model;

use Api\Helper\FuncHelpers;
use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use function Psl\Str\format;

/**
 * @ODM\QueryResultDocument()
 */
class SearchResult
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $title;

    /** @ODM\Field(type="string") */
    private $title_slug;

    /** @ODM\Field(type="string") */
    private $published;

    /** @ODM\Field(type="string") */
    private $author_name;

    /** @ODM\Field(type="int") */
    private $views;

    /** @ODM\Field(type="int") */
    private $views_min;

    /** @ODM\Field(type="bool") */
    private $disableComments;

    /** @ODM\Field(type="collection") */
    private $cover;

    /** @ODM\ReferenceOne(targetDocument=Rubric::class, storeAs="id", inversedBy="rubric.id") */
    private $rubric;

    /** @ODM\Field(type="collection") */
    private $tags;

    /** @ODM\ReferenceOne(targetDocument=Users::class, storeAs="id", inversedBy="authors.id") */
    private $authors;

    /** @ODM\Field(type="string") */
    private $score;

    public function toArray(array $params = []): array
    {
        return [
            "id" => $this->id,
            "title" => $this->getTitle(),
            "slug" => $this->getTitleSlug($params["addToSlug"]??null),
            "published" => $this->getPublished(),
            "author_name" => $this->getAuthorName(),
            "views" => $this->getViews(),
            "views_min" => $this->getViews_min(),
            "disableComments" => $this->getDisableComments(),
            "cover" => $this->getCover(),
            "rubric" => $this->getRubric(),
            "tags" => $this->getTags(),
            "score" => $this->getScore(),
            "_createdLabel" => $this->getCreatedLabel(),
        ];
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTitleSlug(string $addToSlug = null)
    {
        if ($addToSlug) {
            return $this->title_slug."?".$addToSlug;
        }else{
            return $this->title_slug;
        }
    }

    private function getPublished()
    {
        return $this->published;
    }

    private function getAuthorName()
    {
        return $this->author_name;
    }

    private function getViews()
    {
        return $this->views;
    }

    private function getViews_min()
    {
        return $this->views_min;
    }

    private function getDisableComments()
    {
        return $this->disableComments;
    }

    private function getCover()
    {
        if ($this->cover){
            return [$this->cover];
        }else{
            return [""];
        }
    }

    private function getRubric()
    {
        if ($this->rubric) {
            return $this->rubric->toShortArray();
        }else{
            return null;
        }
    }

    private function getTags()
    {
        return (new FuncHelpers)->CreateTag($this->tags);
    }

    private function getAuthors()
    {
        if ($this->authors) {
            return $this->authors->toArray();
        }else{
            return null;
        }
    }

    private function getScore()
    {
        return $this->score;
    }

    /**
     * @throws \Exception
     */
    private function getCreatedLabel()
    {
        $date = new FuncHelpers();
        return $date->humanDate('d F Y', $this->published);
    }


}