<?php
namespace Api\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections;
use Api\Model\Users;
use Api\Repository\CommentsRepository;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;


/**
 * @ODM\Document(collection="collections_rubrics5ef437a267239", repositoryClass="Backend\Repository\RubricsRepository")
 */
class Rubric
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $title;

    /** @ODM\Field(type="collection") */
    private $seo;

    /** @ODM\Field(type="string") */
    private $title_slug;

    /** @ODM\Field(type="collection") */
    private $menu;

    /** @ODM\Field(type="collection") */
    private $sections;

    /** @ODM\Field(type="collection") */
    private $formats;

    /** @ODM\Field(type="string") */
    private $theme;

    /** @ODM\Field(type="bool") */
    private $vbros;



    public function __construct()
    {

    }
    public function toArray(array $params = []): array
    {
        return [
            "id" => $this->id,
            "title" => $this->getTitle(),
            "seo" => $this->getSeo(),
            "slug" => $this->getTitleSlug(),
            "menu" => $this->getMenu(),
            "sections" => $this->getSections(),
            "formats" => $this->getFormats(),
            "theme" => $this->getTheme(),
            "vbros" => $this->vbros,
        ];
    }

    public function toShortArray(): array
    {
        return [
            "id" => $this->id,
            "title" => $this->getTitle(),
            "slug" => $this->getTitleSlug(),
            "formats" => $this->getFormats(),
            "vbros" => $this->vbros,
        ];
    }

    private function getTitle()
    {
        return $this->title;
    }

    private function getSeo()
    {
        return [$this->seo];
    }

    private function getTitleSlug()
    {
        return $this->title_slug;
    }

    private function getMenu()
    {
        return [$this->menu];
    }

    private function getSections()
    {
        foreach ($this->sections as $ficher) {
            $fichers[] = $ficher["value"];
        }
        return $fichers;
    }

    private function getFormats()
    {
        return [$this->formats];
    }

    private function getTheme()
    {
        return $this->theme;
    }


}