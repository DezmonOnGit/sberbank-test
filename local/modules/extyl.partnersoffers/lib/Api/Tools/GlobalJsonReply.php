<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 31.07.2019
 * Time: 20:23
 */

namespace Extyl\Spasibo\Partners\Api\Tools;

class GlobalJsonReply
{
    protected static $_instance = null;

    protected function __construct() {}
    protected function __clone() {}

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (static::$_instance === null)
        {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    protected $AjaxOnly = true;

    public static function getAjaxOnly($default = true)
    {
        $val = static::getInstance()->AjaxOnly;

        return $val !== null ? $val : $default;
    }

    public static function setAjaxOnly($value)
    {
        static::getInstance()->AjaxOnly = $value;
    }

    protected $ReplyObject = null;

    /**
     * @return \Extyl\Spasibo\Partners\Api\Tools\JsonReply
     */
    public static function getReplyObject()
    {
        if (static::getInstance()->ReplyObject === null)
        {
            static::getInstance()->ReplyObject = new JsonReply();
        }

        return static::getInstance()->ReplyObject;
    }

    protected $AlreadyPushed = false;

    public static function getAlreadyPushed($default = false)
    {
        $val = static::getInstance()->AlreadyPushed;

        return $val !== null ? $val : $default;
    }

    public static function setAlreadyPushed($value)
    {
        static::getInstance()->AlreadyPushed = $value;
    }

    public static function config($a, $b = null)
    {
        static::getReplyObject()->config($a, $b);
    }

    public static function addError($msg, $critical = true)
    {
        static::getReplyObject()->addError($msg, $critical);
    }

    public static function addData($a, $b = null)
    {
        static::getReplyObject()->addData($a, $b);
    }

    public static function setData($data)
    {
        static::getReplyObject()->setData($data);
    }

    public static function setStatus($a)
    {
        static::getReplyObject()->setStatus($a);
    }

    public static function push()
    {
        if (
            ! static::getAlreadyPushed()
            && (
                ! static::getAjaxOnly()
                || (
                    static::getAjaxOnly()
                    && bxRequest()->isAjaxRequest()
                )
            )
        ) {
            static::setAlreadyPushed(true);
            static::getReplyObject()->push();
        }
    }
}
