<?php

use Extyl\Spasibo\Partners\Main\Filter;

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