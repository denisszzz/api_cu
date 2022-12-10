<?php

namespace Api\Service;


use Api\Repository\ChecklistRepository;
use Api\Repository\HandbookRepository;
use Api\Repository\InterviewRepository;
use Api\Repository\LongreadRepository;
use Api\Repository\PodcastRepository;
use Api\Repository\ShortreadRepository;
use Api\Repository\TestRepository;
use Api\Repository\UsersRepository;
use Api\Repository\VbrosRepository;

/**
 * Service.
 */
class ArticlesService
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
        UsersRepository $userRepository)
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
    }

    public function getArticle($slug)
    {
        $longreadArticles = $this->longreadRepository->findBy(["title_slug"=>$slug])??[];
        $shortreadArticles = $this->shortreadRepository->findBy(["title_slug"=>$slug])??[];
        $interviewArticles = $this->interviewRepository->findBy(["title_slug"=>$slug])??[];
        $checklistArticles = $this->checklistRepository->findBy(["title_slug"=>$slug])??[];
        $handbookArticles = $this->handbookRepository->findBy(["title_slug"=>$slug])??[];
        $podcastArticles = $this->podcastRepository->findBy(["title_slug"=>$slug])??[];
        $testArticles = $this->testRepository->findBy(["title_slug"=>$slug])??[];
        $vbrosArticles = $this->vbrosRepository->findBy(["title_slug"=>$slug])??[];

        $findArticles = array_merge(
            $longreadArticles,
            $shortreadArticles,
            $interviewArticles,
            $checklistArticles,
            $handbookArticles,
            $podcastArticles,
            $testArticles,
            $vbrosArticles
        );

        $dataArticle = [];
        foreach ($findArticles as $article) {
            $dataArticle = $article->toArray();
        }

//        $authorArticle = $this->userRepository->findBy(["system_account"=>$dataArticle["author"]])??[];
//        foreach ($authorArticle as $item) {
//            $dataArticle["author"] = $item->toArray();
//        }

        $dataSection = [];
        if (isset($dataArticle["sections"])) {
            foreach ($dataArticle["sections"] as $key => $section) {
                if (isset($section["rubric"]["_id"])) {
                    $dataSection[$key]["_field"] = "feature";
                    $dataSection["type"] = "сarousel";
                    $dataSection["rubric"] = null;
                    $dataSection[$key]["list"] = $this->getArticles(
                        $section["rubric"]["_id"],
                        null,
                        ["sort" => "published", "limit" => 6, "offset" => 0]
                    );
                } elseif (isset($section["value"]["tags"])) {
                    $dataSection["_field"] = "feature";
                    $dataSection["type"] = "сarousel";
                    $dataSection["rubric"] = null;
                    $dataSection["list"] = $this->getArticles(
                        null,
                        $section["value"]["tags"][0],
                        ["sort" => "published", "limit" => 6, "offset" => 0]
                    );
                }
            }
        }

        return ["sections"=>[$dataArticle, $dataSection]];
    }

    public function getArticles($rubricId=null, $tags=null, $params=null)
    {
        if (!$rubricId && !$tags) return false;

        if ($rubricId) {
            $longreadArticles = $this->longreadRepository->findBy(["rubric._id"=>$rubricId], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $shortreadArticles = $this->shortreadRepository->findBy(["rubric._id"=>$rubricId], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $interviewArticles = $this->interviewRepository->findBy(["rubric._id"=>$rubricId], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $checklistArticles = $this->checklistRepository->findBy(["rubric._id"=>$rubricId], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $handbookArticles = $this->handbookRepository->findBy(["rubric._id"=>$rubricId], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $podcastArticles = $this->podcastRepository->findBy(["rubric._id"=>$rubricId], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $testArticles = $this->testRepository->findBy(["rubric._id"=>$rubricId], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $vbrosArticles = $this->vbrosRepository->findBy(["rubric._id"=>$rubricId], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
        }elseif ($tags) {
            $longreadArticles = $this->longreadRepository->findBy(["tags"=>$tags], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $shortreadArticles = $this->shortreadRepository->findBy(["tags"=>$tags], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $interviewArticles = $this->interviewRepository->findBy(["tags"=>$tags], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $checklistArticles = $this->checklistRepository->findBy(["tags"=>$tags], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $handbookArticles = $this->handbookRepository->findBy(["tags"=>$tags], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $podcastArticles = $this->podcastRepository->findBy(["tags"=>$tags], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $testArticles = $this->testRepository->findBy(["tags"=>$tags], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
            $vbrosArticles = $this->vbrosRepository->findBy(["tags"=>$tags], ["published"=>"desc"], $params["limit"], $params["offset"])??[];
        }

        $findArticles = array_merge(
            $longreadArticles,
            $shortreadArticles,
            $interviewArticles,
            $checklistArticles,
            $handbookArticles,
            $podcastArticles,
            $testArticles,
            $vbrosArticles
        );

        $dataArticle = [];
        foreach ($findArticles as $article) {
            $dataArticle[] = $article->toShortArray();
        }

        return $dataArticle;
    }
}