<?php
namespace Extyl\Spasibo\Partners\Tools;

use Extyl\Spasibo\Partners\Main\Filter;

class Utils
{
    public static function getAddresses($partnerId)
    {
        $res = \CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => \Extyl\Spasibo\Partners\Tools\Iblocks::getId('sber_partners_addresses'),
                'PROPERTY_PARTNER' => $partnerId,
                [
                    'LOGIC' => 'OR',
                    '=PROPERTY_CITY' => Filter::getCity(),
                    '=PROPERTY_REGION' => Filter::getRegion(),
                ],
            ],
            false,
            false,
            [
                'ID',
                'IBLOCK_ID',
                'PROPERTY_MAP',
                'PROPERTY_ADDRESS',
                'PROPERTY_METRO',
                'PROPERTY_PHONE',
                'PROPERTY_SITE',
                'PROPERTY_TIME_WORK',
            ]
        );

        $maps = [];
        while ($row = $res->Fetch()) {
            $maps[$row['ID']] = array_merge_recursive($maps[$row['ID']] ?: [], [
                'coords' => explode(',', $row['PROPERTY_MAP_VALUE']),
                'address' => $row['PROPERTY_ADDRESS_VALUE'] ?: '',
                'metro' => [$row['PROPERTY_METRO_VALUE']] ?: [],
                'phone' => [$row['PROPERTY_PHONE_VALUE']] ?: [],
                'website' => $row['PROPERTY_SITE_VALUE'] ?: '',
                'time' => $row['PROPERTY_TIME_WORK_VALUE'] ?: '',
            ]);
        }

        return array_values($maps);
    }

    public static function getPartnerByOffer($offerId)
    {
        $res = \CIBlockElement::GetList(
            [],
            [
                '=IBLOCK_ID' => Iblocks::getId('sber_partners'),
                [
                    'LOGIC' => 'OR',
                    '=PROPERTY_CHARGE_OFFERS' => $offerId,
                    '=PROPERTY_ACCEPT_OFFERS' => $offerId,
                ],
            ],
            false,
            false,
            ['ID', 'IBLOCK_ID']
        )->Fetch();

        return [$res['ID'], $res['IBLOCK_ID']];
    }

    public static function getMaxCharge($partnerId)
    {
        $res = \CIBlockElement::GetList(
            [],
            [
                '=IBLOCK_ID' => Iblocks::getId('sber_partners'),
                '=ID' => $partnerId,
            ],
            false,
            false,
            [
                'ID',
                'IBLOCK_ID',
                'PROPERTY_CHARGE_OFFERS',
            ]
        );

        $offers = [];

        while ($row = $res->Fetch()) {
            $offers[] = $row['PROPERTY_CHARGE_OFFERS_VALUE'];
        }

        $offers = array_filter($offers);

        if ( ! $offers) {
            return 0;
        }

        $percents = [];

        $res = \CIBlockElement::GetList(
            [],
            [
                '=IBLOCK_ID' => Iblocks::getId('sber_offers'),
                '=ID' => $offers ?: false,
            ],
            false,
            false,
            [
                'ID',
                'IBLOCK_ID',
                'PROPERTY_CHARGE_PERCENT',
            ]
        );

        while ($row = $res->Fetch()) {
            $percents[] = (float) str_replace(',', '.', $row['PROPERTY_CHARGE_PERCENT_VALUE']);
        }

        return max($percents) ?: 0;
    }
}
