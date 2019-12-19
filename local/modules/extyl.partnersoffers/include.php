<?php
spl_autoload_register(
    function ($className)
    {
        $baseName = 'Extyl\Spasibo\Partners';
        $className = trim(substr($className, strlen($baseName)), '\\');
        $classPath = __DIR__ . '/lib/' . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (file_exists($classPath)) {
            require_once($classPath);
        }
    }
);

if ( ! function_exists('partnersoffers')) {
    function partnersoffers()
    {
        return \Extyl\Spasibo\Partners\App::getInstance();
    }
}

if ( ! function_exists('bxApp')) {
    function bxApp()
    {
        global $APPLICATION;

        return $APPLICATION;
    }
}

if ( ! function_exists('bxCacheManager')) {
    function bxCacheManager ()
    {
        global $CACHE_MANAGER;
        return $CACHE_MANAGER;
    }
}

if (ADMIN_SECTION !== true) {
    partnersoffers()::initFacades();
}