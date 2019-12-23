<?php
const NO_KEEP_STATISTIC = true;
const NO_AGENT_STATISTIC = true;
const NO_AGENT_CHECK = true;
const NOT_CHECK_PERMISSIONS = true;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$reply = new \Extyl\Spasibo\Partners\Api\Tools\JsonReply();

\Extyl\Spasibo\Partners\Main\Filter::setCity($request->get('user-city'));

$reply->reply();
