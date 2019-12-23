<?php

$arResult['addresses'] = $maps = \Extyl\Spasibo\Partners\Tools\Utils::getAddresses($_REQUEST['ELEMENT_ID']);
$this->getComponent()->arResult['addresses'] = $maps;

$offers = [];
$arResult['PROPERTIES']['CHARGE_OFFERS']['VALUE'] = array_intersect(
    $arResult['PROPERTIES']['CHARGE_OFFERS']['VALUE'],
    \Extyl\Spasibo\Partners\Main\PartnersAccess::getAvailableOffers(true) ?: []
);

$offersFilter = &$GLOBALS['offersFilter'];
global $offersFilter;
$offersFilter = [];

foreach ($arResult['PROPERTIES']['CHARGE_OFFERS']['VALUE'] as $offer) {
    $res = CIBlockElement::GetList(
        [],
        [
            'ID' => $offer,
        ]
    );
    if ($row = $res->Fetch()) {
        $ofr = \Extyl\Spasibo\Partners\Tools\Iblocks::mkResulArrayFromId($row['ID'], $row['IBLOCK_ID']);
        $offersFilter['=ID'][] = $ofr['ID'];

        if ( ! $ofr['PREVIEW_TEXT']) {

            $prc = explode('%', $ofr['NAME'], 2);

            $ofr['PREVIEW_TEXT'] = '
                <div class="list__item">
                    <div class="list__percents">' . (count($prc) == 2 ? ($prc[0] . '%') : '') . '</div>
                    <div class="list__content">
                        <div class="list__text">'.(count($prc) == 2 ? $prc[1] : $prc[0]).'</div>
                    </div>
                </div>
            ';
        } else {
            $ofr['PREVIEW_TEXT'] = '
                <div class="list__item">
                    <div class="list__percents"></div>
                    <div class="list__content">
                        <div class="list__text">'.htmlspecialchars_decode($ofr['PREVIEW_TEXT']).'</div>
                    </div>
                </div>
            ';
        }

        $offers[] = $ofr;
    }
}
$arResult['PROPERTIES']['CHARGE_OFFERS'] = $offers;

$offers = [];
$arResult['PROPERTIES']['ACCEPT_OFFERS']['VALUE'] = array_intersect(
    $arResult['PROPERTIES']['ACCEPT_OFFERS']['VALUE'],
    \Extyl\Spasibo\Partners\Main\PartnersAccess::getAvailableOffers(true) ?: []
);

foreach ($arResult['PROPERTIES']['ACCEPT_OFFERS']['VALUE'] as $offer) {
    $res = CIBlockElement::GetList(
        [],
        [
            'ID' => $offer,
        ]
    );
    if ($row = $res->Fetch()) {

        $ofr = \Extyl\Spasibo\Partners\Tools\Iblocks::mkResulArrayFromId($row['ID'], $row['IBLOCK_ID']);
        $offersFilter['=ID'][] = $ofr['ID'];

        if ( ! $ofr['PREVIEW_TEXT']) {

            $prc = explode('%', $ofr['NAME'], 2);

            $ofr['PREVIEW_TEXT'] = '
                <div class="list__item">
                    <div class="list__percents">' . (count($prc) == 2 ? ($prc[0] . '%') : '') . '</div>
                    <div class="list__content">
                        <div class="list__text">'.(count($prc) == 2 ? $prc[1] : $prc[0]).'</div>
                    </div>
                </div>
            ';
        } else {
            $ofr['PREVIEW_TEXT'] = '
                <div class="list__item">
                    <div class="list__percents"></div>
                    <div class="list__content">
                        <div class="list__text">'.htmlspecialchars_decode($ofr['PREVIEW_TEXT']).'</div>
                    </div>
                </div>
            ';
        }

        $offers[] = $ofr;
    }
}
$arResult['PROPERTIES']['ACCEPT_OFFERS'] = $offers;

if ($arResult['PROPERTIES']['RULES']['VALUE']) {
    $arResult['PROPERTIES']['RULES']['VALUE'] = CFile::GetFileArray($arResult['PROPERTIES']['RULES']['VALUE']);
    $arResult['PROPERTIES']['RULES']['VALUE']['SRC'] = CFile::GetFileSRC($arResult['PROPERTIES']['RULES']['VALUE']);
}

$offersFilter = $offersFilter ?: ['=ID' => false];