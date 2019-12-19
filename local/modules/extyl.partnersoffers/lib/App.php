<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 15.12.2019
 * Time: 22:48
 */

namespace Extyl\Spasibo\Partners;


class App
{
    protected static $_instance = null;
    protected function __construct() {}
    protected function __clone() {}

    /**
     * @return \Extyl\Spasibo\Partners\App
     */
    public static function getInstance()
    {
        if (static::$_instance === null) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    public static function initFacades()
    {
        spl_autoload_register(function($className) {
            if (class_exists($facade = __NAMESPACE__ . '\\Facades\\' . $className)) {
                class_alias($facade, $className);
            }
        });
    }
}
