<?php
namespace Api\Model;

use Api\Helper\FuncHelpers;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="collections_longread5ef42ae962393")
 * @ODM\Index(keys={"title"="text","body"="text", "tags"="text"})
 */
class Longread
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
    private $body;

    /** @ODM\Field(type="collection") */
    private $sources;

    /** @ODM\Field(type="string") */
    private $author_name;

    /** @ODM\Field(type="int") */
    private $views;

    /** @ODM\Field(type="int") */
    private $views_min;

    /** @ODM\Field(type="bool") */
    private $disableComments;

    /** @ODM\Field(type="collection") */
    private $seo;

    /** @ODM\Field(type="collection") */
    private $disclaimer;

    /** @ODM\Field(type="collection") */
    private $cover;

    /** @ODM\ReferenceOne(targetDocument=Rubric::class, storeAs="id", inversedBy="rubric.id") */
    private $rubric;

    /** @ODM\Field(type="collection") */
    private $tags;

    /** @ODM\Field(type="collection") */
    private $authors;

    /** @ODM\Field(type="collection") */
    private $rss;

    /** @ODM\Field(type="collection") */
    private $rssDzen;

    /** @ODM\Field(type="collection") */
    private $sections;

    /** @ODM\Field(type="string") */
    private $author;

    public function toArray(): array
    {
        return [
            "_field" => "article",
            "_id" => $this->id,
            "title" => $this->getTitle(),
            "slug" => $this->getTitleSlug(),
            "published" => $this->getPublished(),
            "body" => $this->getBody(),
            "sources" => $this->getSources(),
            "author" => $this->getAuthor(),
            "author_name" => $this->getAuthorName(),
            "views" => $this->getViews(),
            "views_min" => $this->getViews_min(),
            "disableComments" => $this->getDisableComments(),
            "seo" => $this->getSeo(),
            "disclaimer" => $this->getDisclaimer(),
            "cover" => $this->getCover(),
            "sections" => $this->getSections(),
            "rubric" => $this->getRubric(),
            "tags" => $this->getTags(),
            "authors" => $this->getAuthors(),
            "rss" => $this->getRss(),
            "rssDzen" => $this->getRssDzen(),
            "status" => "Published",
            "_createdLabel" => $this->getCreatedLabel(),
        ];
    }

    public function toShortArray(): array
    {
        return [
            "id" => $this->id,
            "title" => $this->getTitle(),
            "slug" => $this->getTitleSlug(),
            "published" => $this->getPublished(),
            "author_name" => $this->getAuthorName(),
            "views" => $this->getViews(),
            "views_min" => $this->getViews_min(),
            "disableComments" => $this->getDisableComments(),
            "cover" => $this->getCover(),
            "tags" => $this->getTags(),
            "rubric" => $this->getRubric(),
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

    public function getTitleSlug()
    {
       return $this->title_slug;
    }

    private function getPublished()
    {
        return $this->published;
    }

    private function getBody()
    {
        return $this->body;
    }

    private function getSources()
    {
        return $this->sources;
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

    private function getSeo()
    {
        return [$this->seo];
    }

    private function getDisclaimer()
    {
        return [$this->disclaimer];
    }

    private function getCover()
    {
        return [$this->cover];
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
        return [$this->authors];
    }

    private function getRss()
    {
        return [$this->rss];
    }

    private function getRssDzen()
    {
        return [$this->rssDzen];
    }

    private function getSections()
    {
        return $this->sections;
    }

    private function getCreatedLabel()
    {
        $date = new FuncHelpers();
        return $date->humanDate('d F Y', $this->published);
    }

    private function getAuthor()
    {
        return $this->author;
    }

}