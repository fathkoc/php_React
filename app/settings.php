<?php

declare(strict_types=1);

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // production'da false yapın
            'logError' => true,
            'logErrorDetails' => true,
            'db' => [
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'database' => 'php-react',  // Veritabanı adınızı girin
                'username' => 'root',   // MySQL kullanıcı adınızı girin
                'password' => '',           // MySQL şifrenizi girin
                'charset' => 'utf8mb4',         // Karakter seti (geniş karakter desteği için)
                'collation' => 'utf8mb4_unicode_ci', // Collation (utf8mb4'e uygun)
            ],
        ],
    ]);
};