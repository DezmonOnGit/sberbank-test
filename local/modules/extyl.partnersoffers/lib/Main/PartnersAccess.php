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
                    '!=PROPERTY_NOT_SHOW_LIST' => 4, // fixme: hardcode, mk normal enum selection
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

        return array_unique($result) ?: false;
    }
}
