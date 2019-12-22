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

    public static function getAvailableOffers()
    {
        $partners = static::getAvailablePartners();
        if ( ! $partners) {
            return false;
        }

        if (Filter::getChargeAccept() === Filter::CHARGE) {
            $selectProp = 'PROPERTY_CHARGE_OFFERS';
            $select = [
                $selectProp,
            ];
            $get = 'PROPERTY_CHARGE_OFFERS_VALUE';
        }
        if (Filter::getChargeAccept() === Filter::ACCEPT) {
            $selectProp = 'PROPERTY_ACCEPT_OFFERS';
            $select = [
                $selectProp,
            ];
            $get = 'PROPERTY_ACCEPT_OFFERS_VALUE';
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
            if ( ! $row[$get]) {
                continue;
            }

            $elem = \CIBlockElement::GetList(
                [],
                [
                    '=ID' => $row[$get],
                    '=IBLOCK_ID' => Iblocks::getId('sber_offers'),
                    '!=PROPERTY_NOT_SHOW_LIST' => 4, // fixme: hardcode, mk normal enum selection
                ],
                false,
                false,
                ['ID', 'IBLOCK_ID', 'PROPERTY_NOT_SHOW_LIST']
            )->Fetch();

            if ( ! $elem) continue;

            $result[] = $row[$get];
        }

        return $result ?: false;
    }
}
