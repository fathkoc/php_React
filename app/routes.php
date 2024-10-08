<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (App $app) {
    $app->get('/users', function (Request $request, Response $response) {
        $users = Capsule::table('users')->get();
        $response->getBody()->write($users->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/posts', function (Request $request, Response $response) {
        $posts = Capsule::table('posts')->get();
        $response->getBody()->write($posts->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->delete('/posts/{id}', function (Request $request, Response $response, $args) {
        $postId = $args['id'];
        Capsule::table('posts')->where('id', $postId)->delete();
        $response->getBody()->write(json_encode(['message' => 'Post deleted']));
        return $response->withHeader('Content-Type', 'application/json');
    });
};
