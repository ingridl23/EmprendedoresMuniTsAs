<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorLaravel\Set\LaravelSetList;

// Reglas de actualización de Laravel, de a una versión por vez (etapa 4).
return RectorConfig::configure()
    ->withPaths([__DIR__ . '/app', __DIR__ . '/config', __DIR__ . '/database', __DIR__ . '/routes', __DIR__ . '/tests'])
    ->withSets([LaravelSetList::LARAVEL_90]);
