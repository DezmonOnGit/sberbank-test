<?php
$res = \Bitrix\Iblock\ElementTable::getList([
    'select' => [
        'ID',
        'NAME',
    ],
    'order' => [
        'SORT' => 'asc',
        'NAME' => 'asc',
    ],
    'filter' => [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        \Extyl\Spasibo\Partners\Main\PartnersAccess::getAvailableCategories(),
    ],
]);

$arResult['CATEGORIES'] = $res->fetchAll();