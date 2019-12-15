<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 15.12.2019
 * Time: 23:07
 */

namespace Extyl\Spasibo\Partners\Facades;


class EventManager extends AbstractFacade
{
    protected static function getObject()
    {
        return \Bitrix\Main\EventManager::getInstance();
    }
}
