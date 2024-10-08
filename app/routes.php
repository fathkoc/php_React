<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (App $app) {
    
    $app->options('/{routes:.+}', function (Request $request, Response $response) {
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    });
    
    $app->get('/users', function (Request $request, Response $response) {
        $users = Capsule::table('users')->get();
        $response->getBody()->write($users->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/posts', function (Request $request, Response $response) {
        // posts ve users tablolarını join ile birleştiriyoruz
        $posts = Capsule::table('posts')
            ->join('users', 'posts.userId', '=', 'users.id')
            ->select('posts.id', 'posts.title', 'posts.body', 'users.username')
            ->get();

        $response->getBody()->write($posts->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->delete('/posts/{id}', function (Request $request, Response $response, array $args) {
        $postId = $args['id'];
    
        $deleted = Capsule::table('posts')->where('id', $postId)->delete();
    
        if ($deleted) {
            $response->getBody()->write(json_encode(['message' => 'Post başarıyla silindi.']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } else {
            $response->getBody()->write(json_encode(['message' => 'Post bulunamadı veya silinemedi.']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    });
};
