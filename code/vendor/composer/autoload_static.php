<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita0725c2a1bdb3c581c0df22ff92e277b
{
    public static $files = array (
        'd0d87d63d4052f8676acd3f57d98051f' => __DIR__ . '/../..' . '/app/config/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita0725c2a1bdb3c581c0df22ff92e277b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita0725c2a1bdb3c581c0df22ff92e277b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita0725c2a1bdb3c581c0df22ff92e277b::$classMap;

        }, null, ClassLoader::class);
    }
}
