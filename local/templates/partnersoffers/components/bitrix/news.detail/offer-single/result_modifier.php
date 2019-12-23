<?php

use Extyl\Spasibo\Partners\Tools\Iblocks;
use Extyl\Spasibo\Partners\Tools\Utils;

if ($arResult['PROPERTIES']['RULES']['VALUE']) {
    $arResult['PROPERTIES']['RULES']['VALUE'] = CFile::GetFileArray($arResult['PROPERTIES']['RULES']['VALUE']);
    $arResult['PROPERTIES']['RULES']['VALUE']['SRC'] = CFile::GetFileSRC($arResult['PROPERTIES']['RULES']['VALUE']);
}

$partner = Iblocks::mkResulArrayFromId(...Utils::getPartnerByOffer($arResult['ID']));

$arResult['PARTNER'] = $partner;

$arResult['addresses'] = Utils::getAddresses($partner['ID']);
