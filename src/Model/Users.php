<?php
namespace Api\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Api\Repository\UserRepository;

/**
 * @ODM\Document(collection="collections_users5f5e7ce867c51", repositoryClass="Backend\Repository\UserRepository")
 */
class Users
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $nickname;

    /** @ODM\Field(type="string") */
    private $email;

    /** @ODM\Field(type="string") */
    private $name;

    /** @ODM\Field(type="string") */
    private $avatar_color;

    /** @ODM\Field(type="int") */
    private $avatar_image;

    /** @ODM\Field(type="string") */
    private $gender;

    /** @ODM\Field(type="int") */
    private $rating_counter;

    /** @ODM\ReferenceMany(targetDocument=Rating::class, storeAs="id", inversedBy="ratings.id") */
    private $rating;

    /** @ODM\Field(type="string") */
    private $system_account;


    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "nickname" => $this->getNickname(),
            "email" => $this->getEmail(),
            "name" => $this->getName(),
            "avatar_color" => $this->getAvatarColor(),
            "avatar_image" => $this->getAvatarImage(),
            "gender" => $this->getGender(),
            "rating_counter" => $this->getRatingCounter(),
            //"rating" => $this->getRating(),
        ];
    }

    private function getNickname()
    {
        return $this->nickname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    private function getName()
    {
        return $this->name;
    }

    private function getAvatarColor()
    {
        return $this->avatar_color;
    }

    private function getAvatarImage()
    {
        return $this->avatar_image;
    }

    private function getGender()
    {
        return $this->gender;
    }

    private function getRatingCounter()
    {
        return $this->rating_counter;
    }

    private function getRating()
    {
//        $ratingArray = [];
//        if ($this->rating) {
//            foreach ($this->rating as $rating) {
//                $ratingArray[] = $rating->toArray();
//            }
//        }
        return $this->rating->toArray();
    }


}