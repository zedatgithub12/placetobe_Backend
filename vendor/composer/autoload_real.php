<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite97b26ee4d952a905fc26012dc8fb54f
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

        spl_autoload_register(array('ComposerAutoloaderInite97b26ee4d952a905fc26012dc8fb54f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite97b26ee4d952a905fc26012dc8fb54f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite97b26ee4d952a905fc26012dc8fb54f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
