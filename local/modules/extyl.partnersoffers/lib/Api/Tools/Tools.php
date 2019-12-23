<?php
namespace Extyl\Spasibo\Partners\Api\Tools;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\GroupTable;
use Bitrix\Iblock\SectionTable;
use Bitrix\Main\UserTable;

class Tools
{
    public static function getIblockId($code, $type = null)
    {
        if (is_numeric($code))
        {
            return $code;
        }

        $filter = ['CODE' => $code];

        if ($type !== null)
        {
            $filter['IBLOCK_TYPE_ID'] = $type;
        }

        $res = IblockTable::getList([
            'select' => ['ID'],
            'filter' => $filter,
            'limit' => 1,
        ]);

        if ( ! $row = $res->fetch())
        {
            throw new \LogicException(sprintf('Iblock "%s" doesn\'t exist', $code));
        }

        return $row['ID'];
    }

    public static function getGroupId($code)
    {
        if (is_numeric($code))
        {
            return $code;
        }

        $res = GroupTable::getList([
            'select' => ['ID'],
            'filter' => ['STRING_ID' => $code],
            'limit' => 1,
        ]);

        if ( ! $row = $res->fetch())
        {
            throw new \LogicException(sprintf('Usergroup "%s" doesn\'t exist', $code));
        }

        return $row['ID'];
    }
    public static function getSectionID($code,$iblock_id)
    {
        if (is_numeric($code))
        {
            return $code;
        }

        $res = SectionTable::getList([
            'select' => ['ID'],
            'filter' => ['CODE' => $code,'IBLOCK_ID'=>$iblock_id],
            'limit' => 1,
        ]);

        if ( ! $row = $res->fetch())
        {
            throw new \LogicException(sprintf('Section "%s" doesn\'t exist', $code));
        }

        return $row['ID'];
    }
    public static function getUserIdByLogin($login)
    {
        $res = UserTable::getList([
            'select' => ['ID'],
            'filter' => ['LOGIN' => $login],
            'limit' => 1,
        ]);

        if ( ! $row = $res->fetch())
        {
            throw new \LogicException(sprintf('User "%s" doesn\'t exist', $login));
        }

        return $row['ID'];
    }

}
