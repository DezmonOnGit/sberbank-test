<?php

use Extyl\Spasibo\Partners\Main\Filter;
use Extyl\Spasibo\Partners\Tools\Iblocks;

$arResult = array_merge($arResult, $arParams['additionalResult'] ?: []);

foreach ($arResult['ITEMS'] as $k => &$item) {
    $partner = CIBlockElement::GetList(
        [],
        [
            'IBLOCK_ID' => Iblocks::getId('sber_partners'),
            [
                'LOGIC' => 'OR',
                '=PROPERTY_CHARGE_OFFERS' => $item['ID'],
                '=PROPERTY_ACCEPT_OFFERS' => $item['ID'],
            ],
        ]
    )->GetNextElement();

    if ( ! $partner) {
        unset($arResult['ITEMS'][$k]);
        continue;
    }

    $item['PARTNER'] = $partner->GetFields();
    $item['PARTNER']['PROPERTIES'] = $partner->GetProperties();

    $item['PARTNER']['PREVIEW_PICTURE'] = CFile::GetFileArray($item['PARTNER']['PREVIEW_PICTURE']);
    $item['PARTNER']['PREVIEW_PICTURE']['SRC'] = CFile::GetFileSRC($item['PARTNER']['PREVIEW_PICTURE']);


//    $item['PREVIEW_PICTURE'] = \CFile::GetFileArray($item['PREVIEW_PICTURE']);
    if ($item['PREVIEW_PICTURE']) {
        $item['PREVIEW_PICTURE']['SRC'] = \CFile::GetFileSRC($item['PREVIEW_PICTURE']);
    } else {
        $item['PREVIEW_PICTURE']['SRC'] = '/dummy.jpg';
    }

//    $item['DETAIL_PICTURE'] = \CFile::GetFileArray($item['DETAIL_PICTURE']);
    if ($item['DETAIL_PICTURE']) {
        $item['DETAIL_PICTURE']['SRC'] = \CFile::GetFileSRC($item['DETAIL_PICTURE']);
    } else {
        $item['DETAIL_PICTURE']['SRC'] = '/dummy.jpg';
    }
}

if (Filter::getCategory() === Filter::CAT_ALL) {
    $arResult['title_text'] = [
        '{val} предложение от партнёров',
        '{val} предложения от партнёров',
        '{val} предложений от партнёров',
    ];
} elseif (Filter::getCategory() === Filter::CAT_POPULAR) {
    $arResult['title_text'] = [
        '{val} предложение от популярных партнёров',
        '{val} предложения от популярных партнёров',
        '{val} предложений от популярных партнёров',
    ];
} else {
    $arResult['title_text'] = [
        '{val} предложение в категории  «{cat_name}»',
        '{val} предложения в категории  «{cat_name}»',
        '{val} предложений в категории  «{cat_name}»',
    ];
}

$arResult = array_merge($arResult, $arParams['forceAdditionalResult'] ?: []);
