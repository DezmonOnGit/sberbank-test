<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 22.12.2019
 * Time: 14:03
 */

namespace Extyl\Spasibo\Partners\Tools;


use Bitrix\Iblock\IblockTable;

class Iblocks
{
    public static function getCode($code)
    {
        if ( ! is_numeric($code))
        {
            return $code;
        }

        $res = IblockTable::getList(
            [
                'select' => ['CODE'],
                'filter' => ['ID' => $code],
                'limit' => 1,
            ]
        );

        return $res->fetch()['CODE'];
    }

    public static function getId($code, $type = null)
    {
        if (is_numeric($code))
        {
            return $code;
        }

        $filter = [
            'CODE' => $code,
        ];

        if ($type !== null)
        {
            $filter['IBLOCK_TYPE_ID'] = $type;
        }

        $res = IblockTable::getList(
            [
                'select' => ['ID'],
                'filter' => $filter,
                'limit' => 1,
            ]
        );

        return $res->fetch()['ID'];
    }
}