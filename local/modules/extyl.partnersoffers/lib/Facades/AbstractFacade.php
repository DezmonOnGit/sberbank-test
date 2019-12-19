<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 15.12.2019
 * Time: 23:08
 */

namespace Extyl\Spasibo\Partners\Facades;


use Bitrix\Main\NotImplementedException;

abstract class AbstractFacade
{
    protected static function getObject()
    {
        throw new NotImplementedException(static::class .' does not extend getObject() method');
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([static::getObject(), $name], $arguments);
    }
}