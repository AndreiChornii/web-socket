<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit93ef635a72686e4bdbef3eb4c7faf1b6
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

        spl_autoload_register(array('ComposerAutoloaderInit93ef635a72686e4bdbef3eb4c7faf1b6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit93ef635a72686e4bdbef3eb4c7faf1b6', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit93ef635a72686e4bdbef3eb4c7faf1b6::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit93ef635a72686e4bdbef3eb4c7faf1b6::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire93ef635a72686e4bdbef3eb4c7faf1b6($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire93ef635a72686e4bdbef3eb4c7faf1b6($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
