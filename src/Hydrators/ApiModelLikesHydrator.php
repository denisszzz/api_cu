<?php

namespace Hydrators;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Hydrator\HydratorException;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\Query\Query;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class ApiModelLikesHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate(object $document, array $data, array $hints = array()): array
    {
        $hydratedData = array();

        /** @Field(type="id") */
        if (isset($data['_id']) || (! empty($this->class->fieldMappings['id']['nullable']) && array_key_exists('_id', $data))) {
            $value = $data['_id'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['id']['type'];
                $return = $value instanceof \MongoDB\BSON\ObjectId ? (string) $value : $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['id']->setValue($document, $return);
            $hydratedData['id'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['titlePost']) || (! empty($this->class->fieldMappings['titlePost']['nullable']) && array_key_exists('titlePost', $data))) {
            $value = $data['titlePost'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['titlePost']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['titlePost']->setValue($document, $return);
            $hydratedData['titlePost'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['idPost']) || (! empty($this->class->fieldMappings['idPost']['nullable']) && array_key_exists('idPost', $data))) {
            $value = $data['idPost'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['idPost']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['idPost']->setValue($document, $return);
            $hydratedData['idPost'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['collectionPost']) || (! empty($this->class->fieldMappings['collectionPost']['nullable']) && array_key_exists('collectionPost', $data))) {
            $value = $data['collectionPost'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['collectionPost']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['collectionPost']->setValue($document, $return);
            $hydratedData['collectionPost'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['sid']) || (! empty($this->class->fieldMappings['sid']['nullable']) && array_key_exists('sid', $data))) {
            $value = $data['sid'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['sid']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['sid']->setValue($document, $return);
            $hydratedData['sid'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['userId']) || (! empty($this->class->fieldMappings['userId']['nullable']) && array_key_exists('userId', $data))) {
            $value = $data['userId'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['userId']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['userId']->setValue($document, $return);
            $hydratedData['userId'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['itemSave']) || (! empty($this->class->fieldMappings['itemSave']['nullable']) && array_key_exists('itemSave', $data))) {
            $value = $data['itemSave'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['itemSave']['type'];
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['itemSave']->setValue($document, $return);
            $hydratedData['itemSave'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['timestamp']) || (! empty($this->class->fieldMappings['timestamp']['nullable']) && array_key_exists('timestamp', $data))) {
            $value = $data['timestamp'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['timestamp']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['timestamp']->setValue($document, $return);
            $hydratedData['timestamp'] = $return;
        }
        return $hydratedData;
    }
}