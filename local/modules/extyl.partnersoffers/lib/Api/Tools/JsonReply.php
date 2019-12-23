<?php
namespace Extyl\Spasibo\Partners\Api\Tools;

use Extyl\Spasibo\Partners\Api\Tools\JsonReply\JsonError;

/**
 * Ajax-queries JSON replying tool
 *
 * Class JsonReply
 * @package Extyl\Spasibo\Partners\Api
 *
 * @author Alex Yashin
 * @version 1.3
 */
class JsonReply
{
    const STATUS_OK = 'ok';
    const STATUS_ERR = 'err';

    /**
     * Response behavior options:
     *
     * Parameter                    | Description                                       | Default value         |
     * -----------------------------|---------------------------------------------------|-----------------------|
     * CONFIG_PUSH_AFTER_CRITICAL   | If `true` immediately after critical error `err`  | true                  |
     *                              | status will be flushed                            |                       |
     * -----------------------------|---------------------------------------------------|-----------------------|
     * CONFIG_GET_HTML_OUTPUT       | If `true` reply will contain `htmlOutput` key     | true                  |
     *                              | where buffer content will be placed. Buffer       |                       |
     *                              | itself will be cleared                            |                       |
     * -----------------------------|---------------------------------------------------|-----------------------|
     * CONFIG_CLEAR_DATA_IF_ERROR   | If `true` after critical error `data` key will    | true                  |
     *                              | be cleaned. Set to `true` by default for          |                       |
     *                              | security reason                                   |                       |
     * -----------------------------|---------------------------------------------------|-----------------------|
     */
    const CONFIG_PUSH_AFTER_CRITICAL = 'pushAfterCritical';
    const CONFIG_GET_HTML_OUTPUT = 'getHtmlOutput';
    const CONFIG_CLEAR_DATA_IF_ERROR = 'clearDataIfError';

    private $errorStack = [];
    private $data = [];
    private $status = 'ok';

    private $hadCriticalError = false;

    private $config = [
        'pushAfterCritical' => true,
        'clearDataIfError' => true,
        'getHtmlOutput' => true,
    ];

    /**
     * Options getter-setter
     *
     * @param string|array $a   string - options key, must be set to static::CONFIG_*
     *                          array -
     *                              options key => value
     * @param mixed|null $b     Has the meaning only if $a is a string
     *                          If `null` - returns current $a option value
     *                          Else - $b is set as new value for $a
     *
     * @return $this|mixed
     */
    public function config($a, $b = null)
    {
        if ($b === null)
        {
            if (is_array($a))
            {
                $this->config = array_merge(
                    $this->config,
                    $a
                );
            }
            else
            {
                return $this->config[$a];
            }
        }
        else
        {
            if (is_string($a))
            {
                $this->config[$a] = $b;
            }
        }

        return $this;
    }

    public function setCritical()
    {
        $this->hadCriticalError = true;
        return $this;
    }

    /**
     * Adds as message to stack error
     *
     * @param string|string[] $msg
     * @param bool            $critical - if `true` a critical error is considered
     *
     * @return $this
     * @deprecated
     * @see \Extyl\Spasibo\Partners\Api\Tools\JsonReply::error()
     */
    public function addError($msg, $critical = true)
    {
        if ( ! is_array($msg))
        {
            $msg = [$msg];
        }
        $this->errorStack = array_merge($this->errorStack, $msg);
        if ($critical)
        {
            $this->hadCriticalError = true;

            if ($this->config(static::CONFIG_PUSH_AFTER_CRITICAL))
            {
                $this->push();
            }
        }

        return $this;
    }

    public function error($error = null)
    {
        if ($error instanceof JsonError) {
            $errObject = $error;
        } else {
            $errObject = new JsonError($this);
            $errObject->title($error);
        }

        $this->errorStack[] = $errObject;

        return $errObject;
    }

    /**
     * Adds data to response (`data` key)
     *
     * @param string|mixed $a   If $b is set, $a is considered to be a key of assocciated array
     *                          Else $a will be added as an element of numeric array
     * @param mixed|null $b
     *
     * @return $this
     */
    public function addData($a, $b = null)
    {
        if ($b !== null)
        {
            $this->data[$a] = $b;
        }
        else
        {
            $this->data[] = $a;
        }

        return $this;
    }

    /**
     * Sets new data array in response (`data` key)
     *
     * @param array $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Sets new status
     *
     * @param bool $a
     *
     * @return $this
     * @deprecated
     */
    public function setStatus($a)
    {
        $this->status = $a;

        return $this;
    }

    public function status(bool $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Clears buffer, prints response data and finishes script
     *
     * @deprecated
     * @see \Extyl\Spasibo\Partners\Api\Tools\JsonReply::reply()
     */
    public function push()
    {
        if ($this->hadCriticalError)
        {
            $this->status = static::STATUS_ERR;

            if ($this->config(static::CONFIG_CLEAR_DATA_IF_ERROR))
            {
                $this->data = [];
            }
        }
        else
        {
            $this->status = static::STATUS_OK;
        }
        $reply = [
            'status' => $this->status,
            'data' => $this->data,
            'errStack' => $this->errorStack,
            'htmlOutput' => $this->config(static::CONFIG_GET_HTML_OUTPUT) ? ob_get_clean() : null,
        ];

        ob_clean();
        header('Content-type: application/json; charset=UTF-8');
        echo json_encode($reply, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function reply(int $code = 200)
    {
        if ($this->hadCriticalError)
        {
            $this->status = false;

            if ($this->config(static::CONFIG_CLEAR_DATA_IF_ERROR)) {
                $this->data = [];
            }
        } else {
            $this->status = true;
        }

        $errors = [];

        foreach ($this->errorStack as $error) {
            $errors[] = [
                'code' => $error->code(),
                'title' => $error->title(),
            ];
        }

        $reply = [
            'status' => $this->status,
            'code' => 200,
            'data' => $this->data,
            'errors' => $errors,
            'html' => $this->config(static::CONFIG_GET_HTML_OUTPUT) ? ob_get_clean() : null,
        ];
//        dd($this);
        ob_clean();
        header('Content-type: application/json; charset=UTF-8');
        http_response_code($code);
        echo json_encode($reply, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS | JSON_UNESCAPED_SLASHES);
        exit(0);
    }
}
