<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 20.12.2019
 * Time: 16:55
 */

namespace Extyl\Spasibo\Partners\Main\Page;

use Bitrix\Main\Context;

class AjaxTool
{
    protected static $_instance = null;

    protected $ajaxTags = [];
    protected $lastKey = null;

    protected function __construct() {}
    protected function __clone() {}

    /**
     * @return \Extyl\Spasibo\Partners\Main\Page\AjaxTool
     */
    public static function getInstance()
    {
        if (static::$_instance === null)
        {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    public static function setTags($areaType, $areaId = null)
    {
        static::getInstance()->ajaxTags[] = [
            'type' => $areaType,
            'id' => $areaId,
        ];

        return sprintf(' data-area-type="%s" data-area-id="%s" ', $areaType, $areaId);
    }

    public static function checkAjaxArea()
    {
        $request = Context::getCurrent()->getRequest();

        if ( ! $request->isAjaxRequest()) return false;

        $last = end(static::getInstance()->ajaxTags);

        if ( ! $last) {
            return false;
        }

        static::getInstance()->lastKey = key(static::getInstance()->ajaxTags);

        if ($last['type'] !== $request->get('areaType')) {
            return false;
        }
        if (
            $last['id'] !== null
            && $request->get('areaId') !== null
            && $last['id'] !== $request->get('areaId')
        ) {
            return false;
        }

        return true;
    }

    public static function startArea()
    {
        if ( ! static::checkAjaxArea()) return false;

        bxApp()->RestartBuffer();
        return true;
    }

    public static function endArea()
    {
        if ( ! static::checkAjaxArea()) {
            if (($key = static::getInstance()->lastKey) !== null) {
                unset(static::getInstance()->ajaxTags[$key]);
            }

            return false;
        }

        echo ob_get_clean();
        die();
    }
}
