<?php

use Slim\App;
use App\Controllers\UserController;
use App\Controllers\PostController;
 
return function (App $app) {

    $app->get('/users', [UserController::class, 'getAllUsers']);
    $app->get('/users/{id}', [UserController::class, 'getUserById']);
    $app->get('/posts', [PostController::class, 'getAllPosts']);
    $app->delete('/posts/{id}', [PostController::class, 'deletePost']);

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });
};
