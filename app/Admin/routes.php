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

});
