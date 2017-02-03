<?php

/** @var \Illuminate\Routing\Router $router  */

$router->get('/', ['as' => 'home', 'uses' => 'UsersController@home']);

$router->get( '/register', ['as' => 'users.register-form', 'uses' => 'UsersController@registerForm']);
$router->post('/register', ['as' => 'users.register',      'uses' => 'UsersController@register']);

$router->post('/login',  ['as' => 'users.login', 'uses' => 'UsersController@login']);
$router->get(' /logout', ['as' => 'users.logout', 'middleware' => 'auth', 'uses' => 'UsersController@logout']);

