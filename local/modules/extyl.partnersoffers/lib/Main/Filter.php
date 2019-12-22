<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 20.12.2019
 * Time: 19:26
 */

namespace Extyl\Spasibo\Partners\Main;

class Filter
{
    const CAT_ALL = 'all';
    const CAT_POPULAR = 'popular';

    const CHARGE = 'charge';
    const ACCEPT = 'accept';

    protected static $_instance = null;

    protected $category = 'all';
    protected $chargeAccept = 'charge';

    protected function __construct() {}
    protected function __clone() {}

    /**
     * @return \Extyl\Spasibo\Partners\Main\Filter
     */
    public static function getInstance()
    {
        if (static::$_instance === null)
        {
            static::$_instance = new static();

            if ( ! $_SESSION['partners_filter']) {
                static::setSessionData();
            }
            static::$_instance->category = $_SESSION['partners_filter']['category'];
            static::$_instance->chargeAccept = $_SESSION['partners_filter']['charge_accept'];
        }
        return static::$_instance;
    }

    protected static function setSessionData()
    {
        $_SESSION['partners_filter'] = [
            'category' => static::getInstance()->category,
            'charge_accept' => static::getInstance()->chargeAccept,
        ];
    }

    public static function setCategory($category)
    {
        static::getInstance()->category = $category;
    }

    public static function setChargeAccept($chargeAccept)
    {
        static::getInstance()->chargeAccept = $chargeAccept;
    }

    public static function getCategory()
    {
        return static::getInstance()->category;
    }

    public static function getChargeAccept()
    {
        return static::getInstance()->chargeAccept;
    }
}
