<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Post;

class PostController
{
    public function getAllPosts(Request $request, Response $response): Response
    {
        $posts = Post::with('user')->get();
        $response->getBody()->write($posts->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function deletePost(Request $request, Response $response, array $args): Response
    {
        $postId = (int) $args['id'];
        $post = Post::find($postId);

        if (!$post) {
            $response->getBody()->write(json_encode(['error' => 'Post not found']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $post->delete();
        return $response->withStatus(204);
    }
}
