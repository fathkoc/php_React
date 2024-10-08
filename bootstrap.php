<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/vendor/autoload.php';

// Container Builder
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'php-react',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
    ],
]);

$container = $containerBuilder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();

// Veritabanı Bağlantısı
$capsule = new Capsule();
$capsule->addConnection($container->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

return $app;
