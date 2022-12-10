<?php

namespace Api\Doctrine\Filter;

use Doctrine\Common\Annotations\Reader;
use Doctrine\DBAL\Query\QueryBuilder;
use Api\Doctrine\Filter\Annotation\Expose;

class ExposedFieldsReader
{
    /** @var Reader */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @phpstan-return array<class-string, array<string, string>>
     */
    public function readExposedFields(QueryBuilder $queryBuilder): array
    {
        $res = [];

        /** @var class-string $entity */
        foreach ($queryBuilder->getRootEntities() as $entity) {
            $res[$entity] = $this->readFieldsFromClass($entity);
        }

        return $res;
    }

    /**
     * @psalm-param class-string $class
     * @psalm-return array<string, string>
     * @return array
     */
    private function readFieldsFromClass(string $class)
    {
        $result = [];
        $reflectionClass = new \ReflectionClass($class);

        foreach ($reflectionClass->getProperties() as $reflectionProperty) {
            $exposeAnnotation = $this->reader->getPropertyAnnotation($reflectionProperty, Expose::class);

            if ($exposeAnnotation instanceof Expose) {
                $serializedName = $exposeAnnotation->serializedName ?: $reflectionProperty->getName();

                $result[$serializedName] = $reflectionProperty->getName();
            }
        }

        return $result;
    }
}