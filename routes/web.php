<?php
use Illuminate\Routing\Router;

/** @var Router $router  */

$router->get('/', ['as' => 'home', 'uses' => 'UsersController@home']);

$router->get( '/register-form', ['as' => 'users.register-form', 'uses' => 'UsersController@registerForm']);
$router->post('/post-register', ['as' => 'users.register',      'uses' => 'UsersController@register']);

$router->post('/login-',  ['as' => 'users.login', 'uses' => 'UsersController@login']);
$router->get( '/logout',  ['as' => 'users.logout', 'middleware' => 'auth', 'uses' => 'UsersController@logout']);

$router->group(['prefix' => 'topics'], function (Router $router) {

    $router->get(   '/',          ['as' => 'topics.index',  'uses' => 'TopicsController@index']);
    $router->get(   '/create',    ['as' => 'topics.create', 'middleware' => 'auth', 'uses' => 'TopicsController@create']);
    $router->post(  '/',          ['as' => 'topics.store',  'middleware' => 'auth', 'uses' => 'TopicsController@store']);
    $router->get(   '/{id}/edit', ['as' => 'topics.edit',   'middleware' => 'auth', 'uses' => 'TopicsController@edit']);
    $router->post(  '/{id}',      ['as' => 'topics.update', 'middleware' => 'auth', 'uses' => 'TopicsController@update']);
    $router->delete('/{id}',      ['as' => 'topics.delete', 'middleware' => 'auth', 'uses' => 'TopicsController@delete']);
    $router->get(   '/{id}',      ['as' => 'topics.show',   'uses' => 'TopicsController@show']);


    $router->get('/category/{id}', ['as' => 'topics.category',  'uses' => 'TopicsController@getByCategory']);

    $router->group(['middleware' => 'auth'], function (Router $router) {

        $router->post(  '/{id}',                   ['as' => 'topics.comments.store',  'uses' => 'TopicsController@storeComment']);
        $router->delete('/{id}/{commentId}',       ['as' => 'topics.comments.delete', 'uses' => 'TopicsController@deleteComment']);
        $router->get(   '/{id}/vote-up',           ['as' => 'topics.comments.vote-up',   'uses' => 'TopicsController@voteCommentUp']);
        $router->get(   '/{id}/vote-down',         ['as' => 'topics.comments.vote-down',   'uses' => 'TopicsController@voteCommentDown']);
        $router->get(   '/{id}/{commentId}/reply', ['as' => 'topics.comments.reply',  'uses' => 'TopicsController@replyComment']);

    });

});
