<?php
const NO_KEEP_STATISTIC = true;
const NO_AGENT_STATISTIC = true;
const NO_AGENT_CHECK = true;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$reply = new \Extyl\Spasibo\Partners\Api\Tools\JsonReply();

if (
    ! is_numeric($request->get('category'))
    && $request->get('category') !== \Extyl\Spasibo\Partners\Main\Filter::CAT_ALL
    && $request->get('category') !== \Extyl\Spasibo\Partners\Main\Filter::CAT_POPULAR
) {
    $reply->error((new \Extyl\Spasibo\Partners\Api\Http\BadRequestError($reply))
        ->title('`category` is required: "all"|"popular"|int')
        ->critical())
    ;
}

if (
    $request->get('chargeAccept') !== \Extyl\Spasibo\Partners\Main\Filter::CHARGE
    && $request->get('chargeAccept') !== \Extyl\Spasibo\Partners\Main\Filter::ACCEPT
) {
    $reply->error((new \Extyl\Spasibo\Partners\Api\Http\BadRequestError($reply))
        ->title('`chargeAccept` is required: "charge"|"accept"')
        ->critical())
    ;
}

\Extyl\Spasibo\Partners\Main\Filter::setCategory($request->get('category'));
\Extyl\Spasibo\Partners\Main\Filter::setChargeAccept($request->get('chargeAccept'));

$reply->status(true)->reply();
