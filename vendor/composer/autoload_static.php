<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd21df9108b4c936f2dd0af1119024ca3
{
    public static $files = array (
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'H' => 
        array (
            'Http\\Promise\\' => 13,
            'Http\\Client\\' => 12,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Http\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/promise/src',
        ),
        'Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/httplug/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Mollie' => 
            array (
                0 => __DIR__ . '/..' . '/mollie/mollie-api-php/src',
            ),
        ),
        'F' => 
        array (
            'FH\\PostcodeAPI' => 
            array (
                0 => __DIR__ . '/..' . '/freshheads/postcode-api-client/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd21df9108b4c936f2dd0af1119024ca3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd21df9108b4c936f2dd0af1119024ca3::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd21df9108b4c936f2dd0af1119024ca3::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
