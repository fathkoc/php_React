<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;

class UserController
{
    public function getAllUsers(Request $request, Response $response): Response
    {
        $users = User::all();
        $response->getBody()->write($users->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getUserById(Request $request, Response $response, array $args): Response
    {
        $userId = (int) $args['id'];
        $user = User::find($userId);

        if (!$user) {
            $response->getBody()->write(json_encode(['error' => 'User not found']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write($user->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }
}
