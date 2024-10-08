<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Production ortamında false yapmanız önerilir
                'logError' => true,
                'logErrorDetails' => true,
                'db' => [
                    'driver' => 'mysql',
                    'host' => '127.0.0.1',
                    'database' => 'php-react',
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                ],
            ]);
        },
    ]);
};
