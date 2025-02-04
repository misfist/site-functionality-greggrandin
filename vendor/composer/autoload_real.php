<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit79748fcebbe0b4d5a437ef9bea3d53bb
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit79748fcebbe0b4d5a437ef9bea3d53bb', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit79748fcebbe0b4d5a437ef9bea3d53bb', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit79748fcebbe0b4d5a437ef9bea3d53bb::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
