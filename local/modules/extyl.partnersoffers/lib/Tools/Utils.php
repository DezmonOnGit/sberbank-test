<?php
namespace Extyl\Spasibo\Partners\Tools;

class Utils
{
    public static function getAddresses($partnerId)
    {
        $res = \CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => \Extyl\Spasibo\Partners\Tools\Iblocks::getId('sber_partners_addresses'),
                'PROPERTY_PARTNER' => $partnerId,
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
}