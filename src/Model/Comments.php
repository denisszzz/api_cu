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
 * @ODM\Document(collection="collections_comments5f63632324fae", repositoryClass="Backend\Repository\CommentsRepository")
 */
class Comments
{
    /** @ODM\Id */
    private $id;

    /** @ODM\ReferenceOne(targetDocument=Longread::class, storeAs="id", inversedBy="source.id") */
    private $source;

    /** @ODM\ReferenceOne(targetDocument=Users::class, storeAs="id", inversedBy="author.id") */
    private $author;

    /** @ODM\ReferenceMany(targetDocument=Comments::class, storeAs="id", inversedBy="reply.id") */
    private $replies = [];

    /** @ODM\Field(type="string") */
    private $text;

    /** @ODM\ReferenceMany(targetDocument=Users::class, storeAs="id", inversedBy="user_liked.id") */
    private $user_liked;

    /** @ODM\ReferenceMany(targetDocument=Users::class, storeAs="id", inversedBy="user_disliked.id") */
    private $user_disliked;

    public function __construct()
    {
        //var_dump($this->author);
        $this->source = new ArrayCollection();
        $this->author = new ArrayCollection();
        $this->replies = new ArrayCollection();
        $this->user_liked = new ArrayCollection();
        $this->user_disliked = new ArrayCollection();
    }
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            //"source" => $this->getSource(),
            "author" => $this->getAuthor(),
            "replies" => $this->getReplies(),
            "text" => $this->getText(),
            "user_liked" => $this->getUserLiked(),
            "user_disliked" => $this->getUserDisliked(),
            "count_liked" => $this->getCount($this->getUserLiked()),
            "count_disliked" => $this->getCount($this->getUserDisliked()),
        ];
    }


    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getSource()
    {
        return $this->source->toArray();
    }

    public function setSource($source): void
    {
        $this->source = $source;
    }

    public function getAuthor()
    {
        $authots = $this->author->toArray();
        return $authots;
    }

    public function setAuthor($user): void
    {
        $this->author = $user;
    }

    public function getReplies()
    {
        $repl = [];
        if ($this->replies) {
            foreach ($this->replies as $reply) {
                $repl[] = $reply->toArray();
            }
        }
        return $repl;
    }

    public function setReplies($reply): void
    {
        $this->replies = $reply;
    }

    public function setUserLiked($user): void
    {
        $this->user_liked = $user;
    }

    public function setUserDisliked($user): void
    {
        $this->user_disliked = $user;
    }

    private function getUserLiked()
    {
        $users = [];
        if ($this->user_liked) {
            foreach ($this->user_liked as $user) {
                $users[] = $user->toArray();
            }
        }
        return $users;
    }

    private function getUserDisliked()
    {
        $users = [];
        if ($this->user_disliked) {
            foreach ($this->user_disliked as $user) {
                $users[] = $user->toArray();
            }
        }
        return $users;
    }

    private function getCount($countable)
    {
        if (is_array($countable)){
            return count($countable);
        }else{
            return 0;
        }
    }


}