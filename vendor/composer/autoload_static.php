<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit034c802e2a829d2b160e7e862d78ef8a
{
    public static $files = array (
        '35d1e42abf4d8c181ae544a92d8f3f6a' => __DIR__ . '/..' . '/kint-php/kint/Kint.class.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'Z' => 
        array (
            'Zeuxisoo\\Whoops\\Provider\\Slim\\WhoopsMiddleware' => 
            array (
                0 => __DIR__ . '/..' . '/zeuxisoo/slim-whoops/src',
            ),
        ),
        'W' => 
        array (
            'Whoops' => 
            array (
                0 => __DIR__ . '/..' . '/filp/whoops/src',
            ),
        ),
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
    );

    public static $classMap = array (
        'BaseController' => __DIR__ . '/../..' . '/lib/base_controller.php',
        'BaseModel' => __DIR__ . '/../..' . '/lib/base_model.php',
        'DB' => __DIR__ . '/../..' . '/lib/database.php',
        'DatabaseConfig' => __DIR__ . '/../..' . '/config/database.php',
        'Kayttaja' => __DIR__ . '/../..' . '/app/models/Kayttaja.php',
        'KayttajaKontrolleri' => __DIR__ . '/../..' . '/app/controllers/KayttajaKontrolleri.php',
        'KayttajanPelaaja' => __DIR__ . '/../..' . '/app/models/KayttajanPelaaja.php',
        'KayttajanPelaajienKontrolleri' => __DIR__ . '/../..' . '/app/controllers/KayttajanPelaajienKontrolleri.php',
        'Laukaus' => __DIR__ . '/../..' . '/app/models/Laukaus.php',
        'LaukausKontrolleri' => __DIR__ . '/../..' . '/app/controllers/LaukausKontrolleri.php',
        'Ottelu' => __DIR__ . '/../..' . '/app/models/Ottelu.php',
        'OtteluKontrolleri' => __DIR__ . '/../..' . '/app/controllers/OtteluKontrolleri.php',
        'Pelaaja' => __DIR__ . '/../..' . '/app/models/Pelaaja.php',
        'PelaajaKontrolleri' => __DIR__ . '/../..' . '/app/controllers/PelaajaKontrolleri.php',
        'Redirect' => __DIR__ . '/../..' . '/lib/redirect.php',
        'View' => __DIR__ . '/../..' . '/lib/view.php',
        'Whoops\\Module' => __DIR__ . '/..' . '/filp/whoops/src/deprecated/Zend/Module.php',
        'Whoops\\Provider\\Zend\\ExceptionStrategy' => __DIR__ . '/..' . '/filp/whoops/src/deprecated/Zend/ExceptionStrategy.php',
        'Whoops\\Provider\\Zend\\RouteNotFoundStrategy' => __DIR__ . '/..' . '/filp/whoops/src/deprecated/Zend/RouteNotFoundStrategy.php',
        'YleinenKontrolleri' => __DIR__ . '/../..' . '/app/controllers/YleinenKontrolleri.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit034c802e2a829d2b160e7e862d78ef8a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit034c802e2a829d2b160e7e862d78ef8a::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit034c802e2a829d2b160e7e862d78ef8a::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit034c802e2a829d2b160e7e862d78ef8a::$classMap;

        }, null, ClassLoader::class);
    }
}
