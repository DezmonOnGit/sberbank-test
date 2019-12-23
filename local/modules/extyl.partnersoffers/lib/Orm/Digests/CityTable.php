<?php
namespace Extyl\Spasibo\Partners\Orm\Digests;

use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Extyl\Spasibo\Partners\Orm\DataManager;

class CityTable extends DataManager
{
    public static function getTableName()
    {
        return 'b_stat_city';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new StringField('COUNTRY_ID'),
            new StringField('REGION'),
            new StringField('NAME'),
            new StringField('XML_ID'),
        ];
    }
}
