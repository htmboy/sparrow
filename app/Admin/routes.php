<?php


use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('positions', PositionController::class);
    $router->resource('themes', ThemeController::class);
    $router->resource('messages', MessageController::class);
    $router->resource('replies', ReplyController::class);

    $router->resource('i-p-libraries', IPLibraryController::class);

    $router->resource('videos', VideoController::class);
    $router->resource('video-carousels', VideoCarouselController::class);
    $router->resource('video-countries', VideoCountryController::class);
    $router->resource('video-discusses', VideoDiscussController::class);
    $router->resource('video-posters', VideoPosterController::class);
    $router->resource('video-sources', VideoSourceController::class);
    $router->resource('video-types', VideoTypeController::class);
});
