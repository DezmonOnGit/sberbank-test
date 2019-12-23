<?php
foreach ($arResult['ITEMS'] as $k => &$item) {
    $partner = CIBlockElement::GetList(
        [],
        [
            'IBLOCK_ID' => \Extyl\Spasibo\Partners\Tools\Iblocks::getId('sber_partners'),
            [
                'LOGIC' => 'OR',
                '=PROPERTY_CHARGE_OFFERS' => $item['ID'],
                '=PROPERTY_ACCEPT_OFFERS' => $item['ID'],
            ],
        ]
    )->GetNextElement();

    if ( ! $partner) {
        unset($arResult['ITEMS'][$k]);
        continue;
    }

    $item['PARTNER'] = $partner->GetFields();
    $item['PARTNER']['PROPERTIES'] = $partner->GetProperties();

    $item['PARTNER']['PREVIEW_PICTURE'] = CFile::GetFileArray($item['PARTNER']['PREVIEW_PICTURE']);
    $item['PARTNER']['PREVIEW_PICTURE']['SRC'] = CFile::GetFileSRC($item['PARTNER']['PREVIEW_PICTURE']);
}