<?php


// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });


$router->group(['prefix' => 'api'], function ($router) {

    $router->post('login', 'AuthController@login');
    
    $router->get('introductions', 'IntroductionController@index');
    $router->get('works', 'WorkController@index');
    $router->get('connects', 'ConnectController@index');
    $router->get('works/{id}', 'WorkController@show');
    $router->get('connects/{id}', 'ConnectController@show');

    $router->group(['middleware' => 'auth:api'], function ($router) {
        $router->get('me', 'AuthController@me');
        $router->post('logout', 'AuthController@logout');
        $router->post('refresh', 'AuthController@refresh');
        
        $router->post('introductions', 'IntroductionController@store');
        $router->put('introductions/{id}', 'IntroductionController@update');
        $router->delete('introductions/{id}', 'IntroductionController@destroy');

        $router->post('works', 'WorkController@store');
        $router->put('works/{id}', 'WorkController@update');
        $router->delete('works/{id}', 'WorkController@destroy');

        $router->post('connects', 'ConnectController@store');
        $router->put('connects/{id}', 'ConnectController@update');
        $router->delete('connects/{id}', 'ConnectController@destroy');

    });

});
