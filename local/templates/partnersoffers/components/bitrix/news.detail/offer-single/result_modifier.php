<?php

use Extyl\Spasibo\Partners\Tools\Iblocks;
use Extyl\Spasibo\Partners\Tools\Utils;

if ($arResult['PROPERTIES']['RULES']['VALUE']) {
    $arResult['PROPERTIES']['RULES']['VALUE'] = CFile::GetFileArray($arResult['PROPERTIES']['RULES']['VALUE']);
    $arResult['PROPERTIES']['RULES']['VALUE']['SRC'] = CFile::GetFileSRC($arResult['PROPERTIES']['RULES']['VALUE']);
}


//$arResult['PREVIEW_PICTURE'] = \CFile::GetFileArray($arResult['PREVIEW_PICTURE']);
if ($arResult['PREVIEW_PICTURE']) {
    $arResult['PREVIEW_PICTURE']['SRC'] = \CFile::GetFileSRC($arResult['PREVIEW_PICTURE']);
} else {
    $arResult['PREVIEW_PICTURE']['SRC'] = '/dummy.jpg';
}

//$arResult['DETAIL_PICTURE'] = \CFile::GetFileArray($arResult['DETAIL_PICTURE']);
if ($arResult['DETAIL_PICTURE']) {
    $arResult['DETAIL_PICTURE']['SRC'] = \CFile::GetFileSRC($arResult['DETAIL_PICTURE']);
} else {
    $arResult['DETAIL_PICTURE']['SRC'] = '/dummy.jpg';
}

$partner = Iblocks::mkResulArrayFromId(...Utils::getPartnerByOffer($arResult['ID']));

$arResult['PARTNER'] = $partner;

$arResult['addresses'] = Utils::getAddresses($partner['ID']);
