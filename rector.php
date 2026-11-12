<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\ValueObject\PhpVersion;

/**
 * Rector (punto 3.2 de la migración).
 *
 * Correr siempre primero en modo prueba, que no modifica archivos:
 *   vendor/bin/rector process --dry-run
 *
 * Por ahora solo se aplican las reglas de modernización de PHP hasta 8.3 (la versión de producción).
 * Las reglas de actualización de Laravel (driftingly/rector-laravel) se suman en la etapa 4,
 * de a una versión por vez.
 */
return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    // Sin esto Rector toma el mínimo de composer.json ("php": "^7.3|^8.0") y descarta toda regla de PHP > 7.3
    ->withPhpVersion(PhpVersion::PHP_83)
    ->withSets([
        LevelSetList::UP_TO_PHP_83,
    ]);
