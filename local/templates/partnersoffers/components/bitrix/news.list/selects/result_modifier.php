<?php

use Extyl\Spasibo\Partners\Main\PartnersAccess;
use Extyl\Spasibo\Partners\Tools\Iblocks;
use Extyl\Spasibo\Partners\Tools\Utils;

$availOffers = PartnersAccess::getAvailableOffers(true, true) ?: [];
foreach ($arResult['ITEMS'] as $i => &$item) {
    $partner = [];

    $offer = $item['PROPERTIES']['OFFERS']['VALUE'];

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

    $item['PARTNERS'] = array_intersect($partner, PartnersAccess::getAvailablePartners(true) ?: []);

    foreach ($item['PARTNERS'] as $k => $partner) {
        $partner = Iblocks::mkResulArrayFromId($partner, Iblocks::getId('sber_partners'));

        $partner['PERCENT_TEXT'] = ($max = Utils::getMaxCharge($partner['ID'])) ? $max . '%' : false;

        $partnerOffers = array_merge(
            $partner['PROPERTIES']['CHARGE_OFFERS']['VALUE'] ?: [],
            $partner['PROPERTIES']['ACCEPT_OFFERS']['VALUE'] ?: []
        );

        if (array_intersect($partnerOffers, PartnersAccess::getAvailableOffers() ?: [])) {
            $item['PARTNERS'][$k] = $partner;
        } else {
            unset($item['PARTNERS'][$k]);
        }
    }

    $item['PARTNERS'] = array_values($item['PARTNERS']);

    if ( ! $item['PARTNERS']) {
        unset($arResult['ITEMS'][$i]);
    }
}

$GLOBALS['offersFilter'] = $arResult['PROPERTIES']['OFFERS']['VALUE'];
$GLOBALS['offersFilter'] = array_intersect($GLOBALS['offersFilter'], PartnersAccess::getAvailableOffers(true) ?: []);
