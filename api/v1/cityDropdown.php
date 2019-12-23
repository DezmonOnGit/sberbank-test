<?php
const NO_KEEP_STATISTIC = true;
const NO_AGENT_STATISTIC = true;
const NO_AGENT_CHECK = true;
const NOT_CHECK_PERMISSIONS = true;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$reply = new \Extyl\Spasibo\Partners\Api\Tools\JsonReply();

if ( ! $request->get('q')) {
    $reply->reply();
}

$result = [];

$res = \Extyl\Spasibo\Partners\Orm\Digests\CityTable::getList([
    'select' => ['NAME'],
    'filter' => [
        'NAME' => $request->get('q') . '%',
    ],
    'limit' => 6,
    'order' => ['NAME' => 'asc'],
]);

while ($row = $res->fetch()) {
    $result[] = $row['NAME'];
}

if (count($result) < 6) {
    $res = \Extyl\Spasibo\Partners\Orm\Digests\CityTable::getList([
        'select' => ['NAME'],
        'filter' => [
            'NAME' => '%' . $request->get('q') . '%',
            '!=NAME' => $result,
        ],
        'limit' => 6 - count($result),
        'order' => ['NAME' => 'asc'],
    ]);

    while ($row = $res->fetch()) {
        $result[] = $row['NAME'];
    }
}

$reply->setData($result)->reply();
