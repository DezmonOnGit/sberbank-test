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

    public static function mkResulArrayFromId($element, $iblock, $filter = [])
    {
        $res = \CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => $iblock,
                'ID' => $element,
                $filter,
            ],
            false,
            false
        )->GetNextElement();

        if ( ! $res) {
            return false;
        }

        $result = $res->GetFields();
        $result['PROPERTIES'] = $res->GetProperties();

        $result['PREVIEW_PICTURE'] = \CFile::GetFileArray($result['PREVIEW_PICTURE']);
        $result['PREVIEW_PICTURE']['SRC'] = \CFile::GetFileSRC($result['PREVIEW_PICTURE']);

        $result['DETAIL_PICTURE'] = \CFile::GetFileArray($result['DETAIL_PICTURE']);
        $result['DETAIL_PICTURE']['SRC'] = \CFile::GetFileSRC($result['DETAIL_PICTURE']);

        return $result;
    }
}