<?php

namespace Api\Service;


use Api\Helper\FuncHelpers;
use Api\Model\Longread;
use Api\Model\SearchQuery;
use Api\Repository\ChecklistRepository;
use Api\Repository\HandbookRepository;
use Api\Repository\InterviewRepository;
use Api\Repository\LongreadRepository;
use Api\Repository\PodcastRepository;
use Api\Repository\SearchQueryRepository;
use Api\Repository\ShortreadRepository;
use Api\Repository\TestRepository;
use Api\Repository\UsersRepository;
use Api\Repository\VbrosRepository;

/**
 * Service.
 */
class SearchQueryService
{
    private SearchQueryRepository $searchQueryRepository;

    public function __construct(SearchQueryRepository $searchQueryRepository)
    {
        $this->searchQueryRepository = $searchQueryRepository;
    }

    /**
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Doctrine\ODM\MongoDB\LockException
     */
    public function insert($input)
    {
        $saveQuery = new SearchQuery();
        $saveQuery->setQuery($input["query"]);
        $saveQuery->setTotal($input["total"]);
        $saveQuery->setTimestamp((new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s'));
        if (isset($_COOKIE['sid'])) $saveQuery->setSid($_COOKIE['sid']);
        $searchQueryId = $this->searchQueryRepository->insert($saveQuery);

        return $searchQueryId;
    }
}