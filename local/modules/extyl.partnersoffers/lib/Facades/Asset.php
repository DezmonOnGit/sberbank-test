<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 15.12.2019
 * Time: 23:15
 */

namespace Extyl\Spasibo\Partners\Facades;

class Asset extends AbstractFacade
{
    protected static function getObject()
    {
        return \Bitrix\Main\Page\Asset::getInstance();
    }
}