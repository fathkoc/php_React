<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

// Veritabanı bağlantısı ayarlarını buraya ekleyin:
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'php-react',  // Veritabanı adınızı girin
    'username'  => 'root',   // MySQL kullanıcı adınızı girin
    'password'  => '',           // MySQL şifrenizi girin
    'charset'   => 'utf8mb4',         // Karakter seti (geniş karakter desteği için)
    'collation' => 'utf8mb4_unicode_ci', // Collation (utf8mb4'e uygun)
]);


$capsule->setAsGlobal();
$capsule->bootEloquent();

// `users` tablosunu oluşturma
if (!Capsule::schema()->hasTable('users')) {
    Capsule::schema()->create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('username');
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('website')->nullable();
        $table->timestamps();
    });

    echo "Users table created successfully.\n";
} else {
    echo "Users table already exists.\n";
}

// `posts` tablosunu oluşturma
if (!Capsule::schema()->hasTable('posts')) {
    Capsule::schema()->create('posts', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('userId')->unsigned();
        $table->string('title');
        $table->text('body');
        $table->timestamps();

    });

    echo "Posts table created successfully.\n";
} else {
    echo "Posts table already exists.\n";
}
