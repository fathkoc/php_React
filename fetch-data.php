<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Veritabanı bağlantısını kurun.
$capsule = new Capsule();
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'php-react',  // Veritabanı adınızı girin
    'username'  => 'root',       // MySQL kullanıcı adınızı girin
    'password'  => '',           // MySQL şifrenizi girin
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

// Eloquent ORM'i kullanmak için kapsül yapılandırmasını global hale getirin.
$capsule->setAsGlobal();
$capsule->bootEloquent();

// JSONPlaceholder'dan kullanıcı verilerini çekme.
$usersJson = file_get_contents('https://jsonplaceholder.typicode.com/users');
$users = json_decode($usersJson, true);

foreach ($users as $user) {
    Capsule::table('users')->insertOrIgnore([
        'id' => $user['id'],
        'name' => $user['name'],
        'username' => $user['username'],
        'email' => $user['email'],
        'phone' => $user['phone'],
        'website' => $user['website'],
    ]);
}

echo "Users data has been inserted.\n";

// JSONPlaceholder'dan post verilerini çekme.
$postsJson = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$posts = json_decode($postsJson, true);

foreach ($posts as $post) {
    Capsule::table('posts')->insertOrIgnore([
        'id' => $post['id'],
        'userId' => $post['userId'],
        'title' => $post['title'],
        'body' => $post['body'],
    ]);
}

echo "Posts data has been inserted.\n";
