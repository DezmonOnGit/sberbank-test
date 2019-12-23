<?php

if ($arResult['PROPERTIES']['RULES']['VALUE']) {
    $arResult['PROPERTIES']['RULES']['VALUE'] = CFile::GetFileArray($arResult['PROPERTIES']['RULES']['VALUE']);
    $arResult['PROPERTIES']['RULES']['VALUE']['SRC'] = CFile::GetFileSRC($arResult['PROPERTIES']['RULES']['VALUE']);
}

$partner = CIBlockElement::GetList(
    [],
    [
        '=IBLOCK_ID' => \Extyl\Spasibo\Partners\Tools\Iblocks::getId('sber_partners'),
        [
            'LOGIC' => 'OR',
            '=PROPERTY_CHARGE_OFFERS' => $arResult['ID'],
            '=PROPERTY_ACCEPT_OFFERS' => $arResult['ID'],
        ],
    ],
    false,
    false,
    ['ID', 'IBLOCK_ID']
)->Fetch();

$partner = \Extyl\Spasibo\Partners\Tools\Iblocks::mkResulArrayFromId($partner['ID'], $partner['IBLOCK_ID']);

$arResult['PARTNER'] = $partner;

$arResult['addresses'] = \Extyl\Spasibo\Partners\Tools\Utils::getAddresses($partner['ID']);
