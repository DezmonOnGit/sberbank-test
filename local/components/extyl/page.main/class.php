<?php

use Extyl\Spasibo\Partners\Main\Filter;

/**
 * @author Alex Yashin <ayashin@extyl-pro.ru>
 * Date: 20.12.2019
 * Time: 1:37
 */

class ExtylPageMainComponent extends CBitrixComponent
{
    protected function fillCurrentCategory()
    {
        $catId = Filter::getCategory();
        $this->arResult['filter']['category']['id'] = $catId;

        if ($catId === Filter::CAT_ALL) {
            $name = 'Все';
        }
        if ($catId === Filter::CAT_POPULAR) {
            $name = 'Популярные';
        }
        if (is_numeric($catId)) {
            $res = \Bitrix\Iblock\ElementTable::getList([
                'select' => ['NAME'],
                'filter' => ['=ID' => $catId],
                'limit' => 1,
            ]);
            $name = $res->fetch()['NAME'];
        }

        $this->arResult['filter']['category']['name'] = $name;
        return $this;
    }

//    protected function fillGlobalFilter()
//    {
//        $this->arResult['filter']
//    }

    public function executeComponent()
    {
        $this
            ->fillCurrentCategory()
            ->includeComponentTemplate()
        ;
    }
}