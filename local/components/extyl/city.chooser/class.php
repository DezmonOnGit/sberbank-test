<?php

class ExtylCityChooserComponent extends CBitrixComponent
{
    protected function setCity()
    {
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        if ($city = $request->get('user-city')) {
            \Extyl\Spasibo\Partners\Main\Filter::setCity($city);

            $_SESSION['filter_city_manual'] = true;
            LocalRedirect(bxApp()->GetCurPageParam('', ['user-city']));
        }
    }

    public function executeComponent()
    {
        $this->setCity();
        $this->includeComponentTemplate();
    }
}
