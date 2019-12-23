<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 20.12.2019
 * Time: 19:26
 */

namespace Extyl\Spasibo\Partners\Main;

use Extyl\Spasibo\Partners\Orm\Digests\CityTable;

class Filter
{
    const CAT_ALL = 'all';
    const CAT_POPULAR = 'popular';

    const CHARGE = 'charge';
    const ACCEPT = 'accept';

    protected static $_instance = null;

    protected $category = 'all';
    protected $chargeAccept = 'charge';
    protected $city = null;
    protected $region = null;

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
            static::$_instance->city = $_SESSION['partners_filter']['city'];
            static::$_instance->region = $_SESSION['partners_filter']['region'];
        }
        return static::$_instance;
    }

    protected static function setSessionData()
    {
        $_SESSION['partners_filter'] = [
            'category' => static::getInstance()->category,
            'charge_accept' => static::getInstance()->chargeAccept,
            'city' => static::getInstance()->city,
            'region' => static::getInstance()->region,
        ];
    }

    public static function setCategory($category)
    {
        static::getInstance()->category = $category;
        static::setSessionData();
    }

    public static function setChargeAccept($chargeAccept)
    {
        static::getInstance()->chargeAccept = $chargeAccept;
        static::setSessionData();
    }

    public static function setCity($city)
    {
        static::getInstance()->city = $city;
        $res = CityTable::getList([
            'filter' => ['NAME' => $city],
            'limit' => 1,
        ])->fetch();
        static::getInstance()->region = $res['REGION'];

        static::setSessionData();
    }

    public static function getCategory()
    {
        return static::getInstance()->category;
    }

    public static function getChargeAccept()
    {
        return static::getInstance()->chargeAccept;
    }

    public static function getCity()
    {
        if ( ! static::getInstance()->city) {
            static::setCity(\Bitrix\Main\Service\GeoIp\Manager::getCityName('', LANGUAGE_ID));
        }

        return static::getInstance()->city;
    }

    public static function getRegion()
    {
        return static::getInstance()->region;
    }

    public static function cityManualSet()
    {
        return $_SESSION['filter_city_manual'];
    }
}
