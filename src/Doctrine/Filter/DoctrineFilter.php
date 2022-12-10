<?php

namespace Api\Doctrine\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Api\Doctrine\Filter\Dto\BinaryFilterOperationDto;
use Api\Doctrine\Filter\Exception\EmptyQueryBuilderException;
use Api\Doctrine\Filter\Exception\InvalidFilterOperatorException;
use Doctrine\ODM\MongoDB\Query\Builder;

class DoctrineFilter
{
    /** @var QueryBuilder */
    private $queryBuilder;

    /** @var int */
    private $parameterIndex = 0;

    /** @var string */
    private $rootAlias;

    /** @var array<string, callable> */
    private $unaryOps;

    /** @var array<string, BinaryFilterOperationDto> */
    private $binaryOps;

    /** @var array<string, mixed> */
    private $ops;

    /** @var array<class-string, array<string, string>> */
    private $exposedFields;

    /**
     * @phpstan-param array<class-string, array<string, string>> $exposedFields
     */
    public function __construct(Builder $queryBuilder, array $exposedFields, string $className)
    {
        $this->queryBuilder = $queryBuilder;
        $this->rootAlias = $this->getRootAlias($className);
        $this->exposedFields = $exposedFields;
        $this->className = $className;

        $this->initializeOperations();
    }


    /**
     * @throws InvalidFilterOperatorException
     */
    public function applyFromQueryString(string $queryString): void
    {
        parse_str($queryString, $res);
        $this->applyFromArray($res);
    }

    /**
     * @param array<string, mixed> $filters
     * @throws InvalidFilterOperatorException
     */
    public function applyFromArray(array $filters): void
    {
        if (isset($filters['orderBy'])) {
            $this->applySortingFromArray($filters['orderBy']);
        }

        $this->applyFiltersFromArray($filters);
    }

    private function getRootAlias(string $className): string
    {
//        $aliases = $this->queryBuilder->getRoo();
//
//        if (!isset($aliases[0])) {
//            throw new EmptyQueryBuilderException('Query builder must contain at least one alias');
//        }

        return $className;
    }

    private function initializeOperations(): void
    {
        $this->binaryOps = [
            'gt' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->gt($field, $val);
            }),

            'gte' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->gte($field, $val);
            }),

            'eq' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->eq($field, $val);
            }),

            'neq' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->neq($field, $val);
            }),

            'lt' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->lt($field, $val);
            }),

            'lte' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->lte($field, $val);
            }),

            'in' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->in($field, $val);
            }),

            'not_in' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->notIn($field, $val);
            }),

            'starts_with' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->like($field, $val);
            }, function ($value) {
                return $this->escapeLikeWildcards($value) . '%';
            }),

            'contains' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->like($field, $val);
            }, function ($value) {
                return '%' . $this->escapeLikeWildcards($value) . '%';
            }),

            'ends_with' => new BinaryFilterOperationDto(function ($field, $val) {
                return $this->queryBuilder->expr()->like($field, $val);
            }, function ($value) {
                return '%' . $this->escapeLikeWildcards($value);
            }),
        ];

        $this->unaryOps = [
            'is_null' => function ($field) {
                return $this->queryBuilder->expr()->isNull($field);
            },
            'is_not_null' => function ($field) {
                return $this->queryBuilder->expr()->isNotNull($field);
            }
        ];

        $this->ops = $this->binaryOps + $this->unaryOps;
    }

    private function escapeLikeWildcards(string $search): string
    {
        return str_replace(['%', '_'], ['\\%', '\\_'], $search);
    }

    /**
     * @param array<string, string> $orderBy
     */
    private function applySortingFromArray(array $orderBy): void
    {
        foreach ($orderBy as $field => $direction) {
            $this->queryBuilder->addOrderBy("{$this->rootAlias}.$field", strtolower($direction));
        }
    }

    /**
     * @param array<string, array<string, string>> $filters
     * @throws InvalidFilterOperatorException
     */
    private function applyFiltersFromArray(array $filters): void
    {
        $this->parameterIndex = 0;
        $exposedFields = $this->exposedFields[$this->className];

        foreach ($filters as $field => $fieldFilters) {
            if (!is_array($fieldFilters) || $field === 'orderBy' || !array_key_exists($field, $exposedFields)) {
                continue;
            }

            foreach ($fieldFilters as $operator => $value) {
                $operator = strtolower($operator);
                $dqlField = $exposedFields[$field];

                if (!in_array($operator, array_keys($this->ops))) {
                    throw new InvalidFilterOperatorException(sprintf(
                        "Unknown operator %s. Supported values are %s",
                        $operator,
                        implode(', ', array_keys($this->ops))
                    ));
                }

                if (in_array($operator, array_keys($this->binaryOps))) {
                    $this->applyBinaryFilter($dqlField, $operator, $value);
                } else {
                    $this->applyUnaryFilter($dqlField, $operator);
                }
            }
        }
    }

    /**
     * @param mixed $value
     */
    private function applyBinaryFilter(string $field, string $operator, $value): void
    {
        $paramName = $this->getNextParameterName($field, $operator);
        $operation = $this->binaryOps[$operator];
        $aliasedFieldName = sprintf("%s.%s", $this->rootAlias, $field);

        $this->queryBuilder
            ->field('timestamp')->{$operator}($value);
//        $this->queryBuilder
//            ->andWhere($operation->getOperationResult($aliasedFieldName, ":$paramName"))
//            ->setParameter($paramName, $operation->getValue($value));
    }

    private function getNextParameterName(string $field, string $operator): string
    {
        $paramName = "doctrine_filter_{$field}_{$operator}_{$this->parameterIndex}";
        $this->parameterIndex++;

        return $paramName;
    }

    private function applyUnaryFilter(string $field, string $operator): void
    {
        $this->queryBuilder->andWhere($this->unaryOps[$operator](sprintf("%s.%s", $this->rootAlias, $field)));
    }
}