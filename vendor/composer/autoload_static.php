<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9545f46df249afc533d9247a9ae71825
{
    public static $prefixesPsr0 = array (
        'O' => 
        array (
            'OAuth2' => 
            array (
                0 => __DIR__ . '/..' . '/adoy/oauth2/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit9545f46df249afc533d9247a9ae71825::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit9545f46df249afc533d9247a9ae71825::$classMap;

        }, null, ClassLoader::class);
    }
}
