<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 09.12.2019
 * Time: 18:26
 */

namespace Extyl\Spasibo\Partners\Api\Http;

use Extyl\Spasibo\Partners\Api\Tools\JsonReply\JsonError;

class ForbiddenError extends JsonError
{
    protected $code = 403;
    protected $title = '403 Forbidden';
}
