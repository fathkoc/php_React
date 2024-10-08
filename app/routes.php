<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (App $app) {
    // Tüm kullanıcıları getir
    $app->get('/users', function (Request $request, Response $response) {
        $users = Capsule::table('users')->get();
        $response->getBody()->write($users->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Tüm gönderileri getir
    $app->get('/posts', function (Request $request, Response $response) {
        $posts = Capsule::table('posts')->get();
        $response->getBody()->write($posts->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Belirli bir kullanıcıya ait gönderileri getir
    $app->get('/posts/{userId}', function (Request $request, Response $response, array $args) {
        $userId = $args['userId'];
        $posts = Capsule::table('posts')->where('userId', $userId)->get();
        $response->getBody()->write($posts->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    });
};
