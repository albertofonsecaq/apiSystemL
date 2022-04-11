<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api','middleware' => ['client.credentials'] ],function () use ($router){
    $router->get('/test', function() use ($router){
        return 'Ready';
    });
    $router->group(['prefix' => 'image'], function () use ($router) {
        $router->post('upload', ['uses' => 'ImageController@upload']);

    });
    $router->group(['prefix' => 'frame-web'], function () use ($router) {
        $router->get('/', ['uses' => 'FrameWebController@list']);
        $router->post('/', ['uses' => 'FrameWebController@store']);
        $router->put('/{id}', ['uses' => 'FrameWebController@update']);
        $router->delete('/{id}', ['uses' => 'FrameWebController@destroy']);
    });
});

$router->group(['prefix' => 'frame-web'], function () use ($router) {
    $router->get('/', ['uses' => 'FrameWebController@list']);
});
