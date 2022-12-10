<?php

namespace Api\Service;


use Api\Repository\InterviewRepository;
use Api\Repository\LongreadRepository;
use Api\Repository\RubricsRepository;
use Api\Repository\ShortreadRepository;

/**
 * Service.
 */
class RubricsService
{
    private $repository;
    private $articlesService;

    /**
     * The constructor.
     *
     * @param RubricsRepository $repository
     */
    public function __construct(RubricsRepository $repository, ArticlesService $articlesService)
    {
        $this->repository = $repository;
        $this->articlesService = $articlesService;
    }

    public function getRubric($slug=false)
    {
        if (!$slug){
            $rubrics = $this->repository->findAll() ?? [];

            $dataRubrics = [];
            foreach ($rubrics as $rubric) {
                $dataRubrics[] = $rubric->toShortArray();
            }

            return $dataRubrics;
        }else {
            $rubrics = $this->repository->findBy(["title_slug" => $slug]) ?? [];

            $dataRubric = [];
            foreach ($rubrics as $rubric) {
                $dataRubric = $rubric->toArray();
            }

            foreach ($dataRubric["sections"] as $key => $section) {
                if (isset($section["rubric"]["_id"])) {
                    $dataRubric["sections"][$key]["_field"] = "feature";
                    $dataRubric["sections"][$key]["list"] = $this->articlesService->getArticles(
                        $section["rubric"]["_id"],
                        null,
                        ["sort" => "published", "limit" => 6, "offset" => 0]
                    );
                } elseif (is_array($section["tags"])) {
                    $dataRubric["sections"][$key]["_field"] = "feature";
                    $dataRubric["sections"][$key]["list"] = $this->articlesService->getArticles(
                        null,
                        $section["tags"][0],
                        ["sort" => "published", "limit" => 6, "offset" => 0]
                    );
                }
            }

            return $dataRubric;
        }
    }

}