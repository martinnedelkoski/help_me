<?php

/** @var \Illuminate\Routing\Router $router  */

$router->get('/home', function() {
    return view('home');
});

Route::get('/', function () {
    return view('welcome');
});

