<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 20.12.2019
 * Time: 18:53
 */

namespace Extyl\Spasibo\Partners\Main;


use Bitrix\Main\Data\Cache;
use Extyl\Spasibo\Partners\Tools\Iblocks;

class PartnersAccess
{
    public static function getAvailableCategories()
    {
//        $cache = Cache::createInstance();
//        if ($cache->initCache(3600, 'availableCategories'))
        // todo
        return [];
    }

    public static function getAvailablePartners()
    {
        $currentCategory = Filter::getCategory();

        if (is_numeric($currentCategory)) {
            $filter = [
                'PROPERTY_CATEGORY' => $currentCategory,
            ];
        } elseif ($currentCategory === Filter::CAT_POPULAR) {
            $filter = [
//                'PROPERTY_IS_POPULAR' => $currentCategory,
            ];
        } else {
            $filter = [];
        }

        if (Filter::getChargeAccept() === Filter::CHARGE) {
            $filter[] = [
                'LOGIC' => 'OR',
                '!=PROPERTY_CHARGE_PERCENT' => false,
                '!=PROPERTY_CHARGE_OFFERS' => false,
            ];
        }

        if (Filter::getChargeAccept() === Filter::ACCEPT) {
            $filter[] = [
                'LOGIC' => 'OR',
                '!=PROPERTY_ACCEPT_PERCENT' => false,
                '!=PROPERTY_ACCEPT_OFFERS' => false,
            ];
        }

        $filter['IBLOCK_ID'] = Iblocks::getId('sber_partners');
        $res = \CIBlockElement::GetList(
            [],
            $filter,
            false,
            false,
            ['ID']
        );

        $result = [];
        while ($row = $res->Fetch()) {
            $result[] = $row['ID'];
        }

        $result = array_intersect($result, static::getPartnersByRegion());

        return $result ?: false;
    }

    public static function getAvailableOffers($ignoreSwitch = false)
    {
        $partners = static::getAvailablePartners();
        if ( ! $partners) {
            return false;
        }

        if ( ! $ignoreSwitch) {
            if (Filter::getChargeAccept() === Filter::CHARGE) {
                $selectProp = 'PROPERTY_CHARGE_OFFERS';
                $select = [
                    $selectProp,
                ];
            }
            if (Filter::getChargeAccept() === Filter::ACCEPT) {
                $selectProp = 'PROPERTY_ACCEPT_OFFERS';
                $select = [
                    $selectProp,
                ];
            }
        } else {
            $select = [
                'PROPERTY_CHARGE_OFFERS',
                'PROPERTY_ACCEPT_OFFERS',
            ];
        }

        $res = \CIBlockElement::GetList(
            [],
            [
                '=ID' => $partners,
                'IBLOCK_ID' => Iblocks::getId('sber_partners'),
            ],
            false,
            false,
            $select
        );

        $result = [];
        while ($row = $res->Fetch()) {
            if (
                ! $row['PROPERTY_CHARGE_OFFERS_VALUE']
                && ! $row['PROPERTY_ACCEPT_OFFERS_VALUE']
            ) {
                continue;
            }

            $rselem = \CIBlockElement::GetList(
                [],
                [
                    '=ID' => [
                        $row['PROPERTY_CHARGE_OFFERS_VALUE'] ?: $row['PROPERTY_ACCEPT_OFFERS_VALUE'],
                        $row['PROPERTY_ACCEPT_OFFERS_VALUE'] ?: $row['PROPERTY_CHARGE_OFFERS_VALUE'],
                    ],
                    '=IBLOCK_ID' => Iblocks::getId('sber_offers'),
                ],
                false,
                false,
                ['ID', 'IBLOCK_ID', 'PROPERTY_NOT_SHOW_LIST']
            )
            ;

            while ($elem = $rselem->Fetch()) {

                $result[] = $elem['ID'];
            }
        }

        $filter = [
            'LOGIC' => 'OR',
            'PROPERTY_IS_FEDERAL' => 5, // fixme hardcore
            'PROPERTY_IS_ONLINE' => 6, // fixme hardcore
        ];

        if (bxUser()->IsAdmin()) {
            $filter['!=PROPERTY_NOT_SHOW_LIST'] = 4; // fixme: hardcode, mk normal enum selection
        }

        $res = \CIBlockElement::GetList(
            [],
            [
                '=IBLOCK_ID' => Iblocks::getId('sber_offers'),
                '=ID' => $result,
                $filter,
            ],
            false,
            false,
            ['ID', 'IBLOCK_ID']
        );

        $return = [];
        while ($row = $res->Fetch()) {
            $return[] = $row['ID'];
        }

        return array_unique($return) ?: false;
    }

    public static function getPartnersByRegion()
    {
        $partners = [];
        if ($addr = static::getAddressesByRegion()) {
            $res = \CIBlockElement::GetList(
                [],
                [
                    '=ID' => $addr,
                    '=IBLOCK_ID' => Iblocks::getId('sber_partners_addresses'),
                ],
                false,
                false,
                [
                    'PROPERTY_PARTNER',
                ]
            );

            while ($row = $res->Fetch()) {
                $partners[] = $row['PROPERTY_PARTNER_VALUE'];
            }
        }

        $res = \CIBlockElement::GetList(
            [],
            [
                '=IBLOCK_ID' => Iblocks::getId('sber_partners'),
                [
                    'LOGIC' => 'OR',
                    '=PROPERTY_IS_FEDERAL' => 1, // fixme: remove hardcore
                    '=PROPERTY_IS_ONLINE' => 3, // fixme: remove hardcore
                    '=PROPERERTY_CITY' => Filter::getCity(),
                    '=PROPERTY_REGION' => Filter::getRegion(),
                ],
            ],
            false,
            false,
            [
                'ID',
                'IBLOCK_ID',
            ]
        );

        while ($row = $res->Fetch()) {
            $partners[] = $row['ID'];
        }

        return array_unique($partners);
    }

    public static function getAddressesByRegion()
    {
        $city = Filter::getCity();
        $region = Filter::getRegion();

        $res = \CIBlockElement::GetList(
            [],
            [
                '=IBLOCK_ID' => Iblocks::getId('sber_partners_addresses'),
                [
                    'LOGIC' => 'OR',
                    '=PROPERTY_CITY' => $city,
                    '=PROPERTY_REGION' => $region,
                ]
            ],
            false,
            false,
            [
                'ID',
                'IBLOCK_ID',
            ]
        );

        $return = [];
        while ($row = $res->Fetch()) {
            $return[] = $row['ID'];
        }

        return $return;
    }
}
