<?php

use Extyl\Spasibo\Partners\Main\Filter;
use Extyl\Spasibo\Partners\Tools\Iblocks;

$partner = [];

$offer = $arResult['PROPERTIES']['OFFERS']['VALUE'];

if ($offer) {

    $offer = array_unique($offer);

    $res = CIBlockElement::GetList(
        [],
        [
            'IBLOCK_ID' => Iblocks::getId('sber_partners'),
            [
                'LOGIC' => 'OR',
                'PROPERTY_CHARGE_OFFERS' => $offer,
                'PROPERTY_ACCEPT_OFFERS' => $offer,
            ],
        ],
        false,
        false,
        [
            'ID',
            'IBLOCK_ID',
            'PROPERTY_CHARGE_OFFERS',
            'PROPERTY_ACCEPT_OFFERS',
        ]
    );

    while ($row = $res->Fetch()) {
        $partner[$row['ID']] = $row['ID'];
    }
}

$arResult['PARTNERS'] = $partner;

foreach ($arResult['PARTNERS'] as &$partner) {

    $partner = Iblocks::mkResulArrayFromId($partner, Iblocks::getId('sber_partners'));

    $partner['PERCENT_TEXT'] = $partner['PROPERTIES']['SET_DISCOUNT']['VALUE'];
}


global $offersFilter;
$offersFilter =& $GLOBALS['offersFilter'];
$offersFilter = $arResult['PROPERTIES']['OFFERS']['VALUE'];
$offersFilter = ['=ID' => array_intersect($offersFilter, \Extyl\Spasibo\Partners\Main\PartnersAccess::getAvailableOffers(true) ?: []) ?: false];