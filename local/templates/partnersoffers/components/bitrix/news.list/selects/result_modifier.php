<?php

use Extyl\Spasibo\Partners\Main\Filter;
use Extyl\Spasibo\Partners\Main\PartnersAccess;
use Extyl\Spasibo\Partners\Tools\Iblocks;
use Extyl\Spasibo\Partners\Tools\Utils;

$availOffers = PartnersAccess::getAvailableOffers(false) ?: [];
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

    $item['PARTNERS'] = array_intersect($partner, PartnersAccess::getAvailablePartners() ?: []);

    foreach ($item['PARTNERS'] as &$partner) {
        $partner = Iblocks::mkResulArrayFromId($partner, Iblocks::getId('sber_partners'));

        $partner['PERCENT_TEXT'] = ($max = Utils::getMaxCharge($partner['ID'])) ? $max.'%' : false;
    }
    unset($partner);
}

$GLOBALS['offersFilter'] = $arResult['PROPERTIES']['OFFERS']['VALUE'];
$GLOBALS['offersFilter'] = array_intersect($GLOBALS['offersFilter'], PartnersAccess::getAvailableOffers(true) ?: []);
