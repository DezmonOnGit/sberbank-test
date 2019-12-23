<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 09.12.2019
 * Time: 17:56
 */

namespace Extyl\Spasibo\Partners\Api\Tools\JsonReply;

use Extyl\Spasibo\Partners\Api\Tools\JsonReply;
use Bitrix\Main\Localization\Loc;

/**
 * Class JsonError
 * @package Extyl\Spasibo\Partners\Api\Tools\JsonReply
 *
 * @method error(string $error, bool $critical = true): JsonError
 * @method reply(int $code = 200): void
 */
class JsonError
{
    protected $title = '';
    protected $critical = false;
    protected $code = 200;

    protected $jsonReply = null;

    public function __construct(JsonReply $jsonReply)
    {
        $this->jsonReply = $jsonReply;
    }

    public function title(string $title = null)
    {
        if ($title === null) {
            return Loc::getMessage($this->title) ?: $this->title;
        }

        $this->title = $title;

        return $this;
    }

    public function critical(bool $critical = true)
    {
        if ($critical) {
            $this->jsonReply->setCritical();

            if ($this->jsonReply->config(JsonReply::CONFIG_PUSH_AFTER_CRITICAL)) {
                $this->jsonReply->reply($this->code());
            }
        }

        return $this;
    }

    public function code($code = null)
    {
        if ($code === null) {
            return $this->code;
        }

        $this->code = $code;

        return $this;
    }

    public function __toString()
    {
        return Loc::getMessage($this->title) ?: $this->title;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->jsonReply, $name)) {
            return call_user_func_array([$this->jsonReply, $name], $arguments);
        }
    }
}
