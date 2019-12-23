<?php

use Bitrix\Iblock\ElementTable;
use Extyl\Spasibo\Partners\Tools\Iblocks;
use Extyl\Spasibo\Partners\Tools\Utils;
const NO_KEEP_STATISTIC = true;
const NO_AGENT_STATISTIC = true;
const NO_AGENT_CHECK = true;
const NOT_CHECK_PERMISSIONS = true;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$reply = new \Extyl\Spasibo\Partners\Api\Tools\JsonReply();

\Bitrix\Main\Loader::includeModule('iblock');

$queryString = str_replace(['%', '_'], ['\\%', '\\_'], $request->get('q'));

$queryTemplate = [
    'select' => [
        'ID',
        'NAME',
        'PREVIEW_PICTURE',
        'IBLOCK_ID',
    ],
    'filter' => [
        'IBLOCK_ID' => [
            Iblocks::getId('sber_partners'),
            Iblocks::getId('sber_offers'),
        ],
    ],
    'limit' => 10,
];

$res = ElementTable::getList(array_merge_recursive(
    $queryTemplate, [
        'filter' => [
            'NAME' => $queryString . '%',
        ]
    ]
));

$arData = [];
$found = [];
while ($row = $res->fetch()) {
    $item = [
        'name' => $row['NAME'],
        'picture' => null,
        'href' => null,
    ];

    $item['picture'] = CFile::GetFileSRC(CFile::GetFileArray($row['PREVIEW_PICTURE']));

    switch ($row['IBLOCK_ID']) {
        case Iblocks::getId('sber_partners'): {
            $item['href'] = '/partners/'.$row['ID'].'/';
            break;
        }
        case Iblocks::getId('sber_offers'): {
            $item['href'] = '/offers/'.$row['ID'].'/';
            $item['picture'] = Iblocks::mkResulArrayFromId(...Utils::getPartnerByOffer($row['ID']))['PREVIEW_PICTURE']['SRC'];
            break;
        }
    }

    $arData[] = $item;
    $found[] = $row['ID'];
}

if (count($arData) < 10) {

    $res = ElementTable::getList(array_merge(array_merge_recursive(
        $queryTemplate, [
            'filter' => [
                'NAME' => '%' . $queryString . '%',
                '!=ID' => $found,
            ],
        ]
    )), ['limit' => 10 - count($arData)]);

    while ($row = $res->fetch()) {
        $item = [
            'name' => $row['NAME'],
            'picture' => null,
            'href' => null,
        ];

        $item['picture'] = CFile::GetFileSRC(CFile::GetFileArray($row['PREVIEW_PICTURE']));

        switch ($row['IBLOCK_ID']) {
            case Iblocks::getId('sber_partners'): {
                $item['href'] = '/partners/'.$row['ID'].'/';
                break;
            }
            case Iblocks::getId('sber_offers'): {
                $item['href'] = '/offers/'.$row['ID'].'/';
                $item['picture'] = Iblocks::mkResulArrayFromId(...Utils::getPartnerByOffer($row['ID']))['PREVIEW_PICTURE']['SRC'];
                break;
            }
        }

        $arData[] = $item;
    }
}

if ( ! $arData) {
    $reply->error('По вашему запросу ничего не найдено');
}

$reply->setData($arData)->reply();
