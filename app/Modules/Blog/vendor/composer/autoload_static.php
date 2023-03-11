<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita0b47b0e15694484bd8c2ef03843b564
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Modules\\Blog\\DataBase\\Factories\\' => 36,
            'App\\Modules\\Blog\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Modules\\Blog\\DataBase\\Factories\\' => 
        array (
            0 => __DIR__ . '/../..' . '/DataBase/Factories',
        ),
        'App\\Modules\\Blog\\' => 
        array (
            0 => '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita0b47b0e15694484bd8c2ef03843b564::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita0b47b0e15694484bd8c2ef03843b564::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita0b47b0e15694484bd8c2ef03843b564::$classMap;

        }, null, ClassLoader::class);
    }
}
