<?php
use Api\Controller\ArticlesController;
use Api\Controller\CommentsController;
use Api\Controller\LikesController;
use Api\Controller\SearchQueryController;
use Api\Controller\TagsController;
use Api\Controller\UsersController;
use Api\Controller\SearchController;
use Api\Controller\RubricsController;
use Api\Controller\Dashboard\LikeController;
use Api\Controller\Dashboard\SearchQueryController as SearchQueryDashboard;

use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function (App $app) {
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });
    $app->get('/comments/{id}', CommentsController::class)->setName('comments');
    $app->get('/article/{slug}', ArticlesController::class)->setName('article');
    $app->get('/user/{id}', UsersController::class)->setName('user');
    $app->get('/search/{query}', SearchController::class)->setName('search');
    $app->get('/rubric/{slug}', RubricsController::class)->setName('rubric');
    $app->get('/rubric', RubricsController::class)->setName('rubric');
    $app->get('/tag/{tag}', TagsController::class)->setName('tag');
    $app->post('/searchQuery', SearchQueryController::class)->setName('searchQuery');
    $app->post('/likes/set', [LikesController::class, 'set'])->setName('like');
    $app->get('/likes/{id}', [LikesController::class, 'get'])->setName('likeGet');

    $app->get('/dashboard/likes', [LikeController::class, 'getAll'])->setName('like');
    $app->get('/dashboard/likes/must', [LikeController::class, 'getMust'])->setName('like');

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN'] ?? 'http://localhost')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Max-Age', '1000')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding, Cockpit-Token')
            ->withHeader('Access-Control-Allow-Methods', 'PUT, POST, GET, OPTIONS, DELETE')
            ->withHeader('Access-Control-Expose-Headers', 'true')
            ->withHeader('content-type', 'application/json');
    });
};