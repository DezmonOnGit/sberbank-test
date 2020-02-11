<?php

use Extyl\Spasibo\Partners\Main\Filter;
use Extyl\Spasibo\Partners\Tools\Arrays;

$arResult = array_merge($arResult, $arParams['additionalResult'] ?: []);

foreach ($arResult['ITEMS'] as &$item) {
    if (
        $item['PROPERTIES']['CHARGE_PERCENT']['VALUE']
        && Filter::getChargeAccept() === Filter::CHARGE
    ) {
        $item['DISPLAY_PERCENT'] = $item['PROPERTIES']['CHARGE_PERCENT']['VALUE'];
        $item['DISPLAY_PERCENT_TEXT'] = 'Спасибо от суммы покупки';
    } elseif (
        $item['PROPERTIES']['ACCEPT_PERCENT']['VALUE']
        && Filter::getChargeAccept() === Filter::ACCEPT
    ) {
        $item['DISPLAY_PERCENT'] = $item['PROPERTIES']['ACCEPT_PERCENT']['VALUE'];
        $item['DISPLAY_PERCENT_TEXT'] = 'Скидки за бонусы Спасибо';
    }
}
unset($item);

if (Filter::getCategory() === Filter::CAT_POPULAR) {

    $popular = [];
    $others = [];

    foreach ($arResult['ITEMS'] as $item) {
        if ($item['PROPERTIES']['IS_POPULAR']['VALUE_XML_ID'] === 'Y') {
            $popular[] = $item;
        } else {
            $others[] = $item;
        }
    }

    $arResult['ITEMS'] = array_merge(
        Arrays::sortByInternalKey($popular, 'SHOW_COUNTER', SORT_DESC),
        $others
    );
}
