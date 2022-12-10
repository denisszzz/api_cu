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
class TagsService
{

    private HandbookRepository $handbookRepository;
    private ChecklistRepository $checklistRepository;
    private PodcastRepository $podcastRepository;
    private TestRepository $testRepository;
    private VbrosRepository $vbrosRepository;
    private LongreadRepository $longreadRepository;
    private ShortreadRepository $shortreadRepository;
    private InterviewRepository $interviewRepository;
    private UsersRepository $userRepository;
    private SearchQueryRepository $searchQueryRepository;

    /**
     * The constructor.
     *
     * @param LongreadRepository $longreadRepository
     * @param ShortreadRepository $shortreadRepository
     * @param InterviewRepository $interviewRepository
     * @param ChecklistRepository $checklistRepository
     * @param HandbookRepository $handbookRepository
     * @param PodcastRepository $podcastRepository
     * @param TestRepository $testRepository
     * @param VbrosRepository $vbrosRepository
     * @param UsersRepository $userRepository
     */
    public function __construct(
        LongreadRepository $longreadRepository,
        ShortreadRepository $shortreadRepository,
        InterviewRepository $interviewRepository,
        ChecklistRepository $checklistRepository,
        HandbookRepository $handbookRepository,
        PodcastRepository $podcastRepository,
        TestRepository $testRepository,
        VbrosRepository $vbrosRepository,
        UsersRepository $userRepository,
        SearchQueryRepository $searchQueryRepository
    )
    {
        $this->longreadRepository = $longreadRepository;
        $this->shortreadRepository = $shortreadRepository;
        $this->interviewRepository = $interviewRepository;
        $this->checklistRepository = $checklistRepository;
        $this->handbookRepository = $handbookRepository;
        $this->podcastRepository = $podcastRepository;
        $this->testRepository = $testRepository;
        $this->vbrosRepository = $vbrosRepository;
        $this->userRepository = $userRepository;
        $this->searchQueryRepository = $searchQueryRepository;
    }

    /**
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Doctrine\ODM\MongoDB\LockException
     */
    public function findTag($tag, $params): array
    {
        $longreadArticles = $this->longreadRepository->searchByTag($tag);
        $interviewArticles = $this->interviewRepository->searchByTag($tag);
        $checklistArticles = $this->checklistRepository->searchByTag($tag);
        $podcastArticles = $this->podcastRepository->searchByTag($tag);
        $testArticles = $this->testRepository->searchByTag($tag);
        $vbrosArticles = $this->vbrosRepository->searchByTag($tag);
        $handbookArticles = $this->handbookRepository->searchByTag($tag);
        $shortreadArticles = $this->shortreadRepository->searchByTag($tag);

        $dataArticle = [];


        foreach ($longreadArticles as $longread) {
            $dataArticle[] = $longread->toArray();
        }

        foreach ($interviewArticles as $interview) {
            $dataArticle[] = $interview->toArray();
        }

        foreach ($checklistArticles as $cheklist) {
            $dataArticle[] = $cheklist->toArray();
        }

        foreach ($podcastArticles as $podcast) {
            $dataArticle[] = $podcast->toArray();
        }

        foreach ($testArticles as $test) {
            $dataArticle[] = $test->toArray();
        }

        foreach ($vbrosArticles as $vbros) {
            $dataArticle[] = $vbros->toArray();
        }

        foreach ($shortreadArticles as $shortread) {
            $dataArticle[] = $shortread->toArray();
        }
        foreach ($handbookArticles as $handbook) {
            $dataArticle[] = $handbook->toArray();
        }

        usort($dataArticle, [self::class, "cmp"]);

        $outputArray = [];
        $start = 0;
        if (isset($params["skip"])) $start = $params["skip"];
        $end = $start+10;
        if ($end>count($dataArticle)) $end = count($dataArticle);

        for ($start; $start<$end; $start++) {
            $outputArray[] = $dataArticle[$start];
        }

        return ["total" => count($dataArticle), "entries" => $outputArray];
    }

    static function cmp($a, $b) {
        if ($a["published"] == $b["published"]) {
            return 0;
        }
        return ($a["published"] > $b["published"]) ? -1 : 1;
    }

}