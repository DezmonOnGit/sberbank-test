<?php
/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 20.12.2019
 * Time: 0:41
 */

namespace Extyl\Spasibo\Partners\Orm\Digests;


use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Extyl\Spasibo\Partners\Orm\DataManager;

class PartnerViewTable extends DataManager
{
    public static function getTableName()
    {
        return 'sber_parnter_view';
    }

    public static function getMap()
    {
        return [
            new IntegerField('partner', [
                'column_name' => 'UF_PARTNER',
                'primary' => true,
            ]),
            new StringField('region', [
                'column_name' => 'UF_REGION',
                'primary' => true,
            ]),
            new IntegerField('views', [
                'column_name' => 'UF_VIEWS',
            ]),
        ];
    }
}