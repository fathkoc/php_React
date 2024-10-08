<?php

require __DIR__ . '/../bootstrap.php';

$app = require __DIR__ . '/../bootstrap.php';

// Middleware'i ekleyin
$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

// Rotaları ekleyin
$routes = require __DIR__ . '/../routes/web.php';
$routes($app);

$app->run();
