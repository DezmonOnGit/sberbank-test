<? bxApp()->SetPageProperty('title_class', 'display-none'); ?>
<main class="main main--offsets">
    <div class="main__item partners">
        <div class="partners__inner container container--small">
            <div class="partners__info">
                <div class="title title__partners">
                    <div class="partners__img-box">
                        <img class="partners__img rounded" src="<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arResult['NAME'] ?>">
                    </div>
                    <div class="partners__name"><?= $arResult['NAME'] ?></div>
                </div>
                <div class="partners__details">
                    <? if ($arResult['PROPERTIES']['PHONES']['VALUE']): ?>
                        <div class="list list__partners">
                            <div class="title title__list">Телефон</div>
                            <div class="list__inner">
                                <div class="list__item">
                                    <? foreach ($arResult['PROPERTIES']['PHONES']['VALUE'] as $phone): ?>
                                        <a href="tel:<?= preg_replace('/[^+0-9]/', '', $phone) ?>" class="link link__phone link--theme-black"><?= $phone ?></a>
                                    <? endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                    <? if ($arResult['PROPERTIES']['SITES']['VALUE']): ?>
                        <div class="list list__partners">
                            <div class="title title__list">Сайт</div>
                            <div class="list__inner">
                                <div class="list__item">
                                    <? foreach ($arResult['PROPERTIES']['SITES']['VALUE'] as $site): ?>
                                        <a href="<?= $site ?>" class="link link__phone link--theme-green" target="_blank"><?= $site ?></a>
                                    <? endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                </div>
            </div>
            <? if ($arResult['addresses']): ?>
                <div class="map map--box">
                    <div id="map-partner" class="map__inner"></div>
                    <div class="partners__addresses">
                        <a href="#partner-addresses" class="link link--theme-green link--modal-opener"><?= \Extyl\Spasibo\Partners\Tools\Lang::getNumericString(
                            count($arResult['addresses']),
                            [
                                '{val} адрес',
                                '{val} адреса',
                                '{val} адресов',
                            ]
                        ); ?></a>
                    </div>
                </div>
            <? endif; ?>
            <div class="tabs tabs__partners">
                <nav class="tabs__nav">
                    <? if ($arResult['PROPERTIES']['CHARGE_OFFERS'] || $arResult['PROPERTIES']['CHARGE_PERCENT']['VALUE']): ?>
                        <button class="button button--theme-dashed button--active button__tabs-nav" type="button" data-tab-index="1">Начисление бонусов</button>
                    <? endif; ?>
                    <? if ($arResult['PROPERTIES']['ACCEPT_OFFERS'] || $arResult['PROPERTIES']['ACCEPT_PERCENT']['VALUE']): ?>
                        <button class="button button--theme-dashed button__tabs-nav
                            <?= ! ($arResult['PROPERTIES']['CHARGE_OFFERS'] || $arResult['PROPERTIES']['CHARGE_PERCENT']['VALUE']) ? 'button--active' : '' ?>
                        " type="button" data-tab-index="2">Оплата бонусами</button>
                    <? endif; ?>
                </nav>
                <div class="tabs__content">
                    <? if ($arResult['PROPERTIES']['CHARGE_OFFERS'] || $arResult['PROPERTIES']['CHARGE_PERCENT']['VALUE']): ?>
                    <div class="tabs__item tabs__item--active" data-tab-index="1">
                        <div class="list list__bonuses list--theme-night">
<!--                            <div class="list__item list__item--highlight">-->
<!--                                <div class="list__percents">99%</div>-->
<!--                                <div class="list__content">-->
<!--                                    <div class="marks">-->
<!--                                        <div class="marks__inner">-->
<!--                                            <div class="marks__item">-->
<!--                                                <div class="marks__text">Для Вас</div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="list__text">В рамках вашего уровня привилегий «Огромное спасибо» до 31 мая 2019</div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <? foreach ($arResult['PROPERTIES']['CHARGE_OFFERS'] as $offer): ?>
                                <?= $offer['PREVIEW_TEXT'] ?>
                            <? endforeach; ?>
                        </div>
                        <?= htmlspecialchars_decode($arResult['PROPERTIES']['CHARGE_OFFERS_TXT']['VALUE']['TEXT']) ?>
                    </div>
                    <? endif; ?>
                    <? if ($arResult['PROPERTIES']['ACCEPT_OFFERS'] || $arResult['PROPERTIES']['ACCEPT_PERCENT']['VALUE']): ?>
                    <div class="tabs__item" data-tab-index="2">
                        <div class="list list__bonuses list--theme-night">
<!--                            <div class="list__item list__item--highlight">-->
<!--                                <div class="list__percents">99%</div>-->
<!--                                <div class="list__content">-->
<!--                                    <div class="marks">-->
<!--                                        <div class="marks__inner">-->
<!--                                            <div class="marks__item">-->
<!--                                                <div class="marks__text">Для Вас</div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="list__text">В рамках вашего уровня привилегий «Огромное спасибо» до 31 мая 2019</div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <? foreach ($arResult['PROPERTIES']['ACCEPT_OFFERS'] as $offer): ?>
                                <?= $offer['PREVIEW_TEXT'] ?>
                            <? endforeach; ?>
                        </div>
                    </div>
                    <? endif; ?>
                </div>
            </div>
            <div class="partners__footer">
                <? if ($arResult['PROPERTIES']['RULES']['VALUE']): ?>
                    <a href="<?= $arResult['PROPERTIES']['RULES']['VALUE']['SRC'] ?>" target="_blank" class="link link--theme-grey link__download">Правила акции</a>
                <? endif; ?>
            </div>
        </div>
    </div>
    <div class="main__item offers">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "offerinpartner",
            array(
                "COMPONENT_TEMPLATE" => "offerinpartner",
                "IBLOCK_TYPE" => "partnersoffers",
                "IBLOCK_ID" => "5",
                "NEWS_COUNT" => "2",
                "USE_SEARCH" => "N",
                "USE_RSS" => "N",
                "USE_RATING" => "N",
                "USE_CATEGORIES" => "N",
                "USE_REVIEW" => "N",
                "USE_FILTER" => "N",
                "FILTER_NAME" => "offersFilter",
                "FILTER_FIELD_CODE" => array(
                    0 => "ID",
                    1 => "CODE",
                    2 => "XML_ID",
                    3 => "NAME",
                    4 => "TAGS",
                    5 => "SORT",
                    6 => "PREVIEW_TEXT",
                    7 => "PREVIEW_PICTURE",
                    8 => "DETAIL_TEXT",
                    9 => "DETAIL_PICTURE",
                    10 => "DATE_ACTIVE_FROM",
                    11 => "ACTIVE_FROM",
                    12 => "DATE_ACTIVE_TO",
                    13 => "ACTIVE_TO",
                    14 => "SHOW_COUNTER",
                    15 => "SHOW_COUNTER_START",
                    16 => "IBLOCK_TYPE_ID",
                    17 => "IBLOCK_ID",
                    18 => "IBLOCK_CODE",
                    19 => "IBLOCK_NAME",
                    20 => "IBLOCK_EXTERNAL_ID",
                    21 => "DATE_CREATE",
                    22 => "CREATED_BY",
                    23 => "CREATED_USER_NAME",
                    24 => "TIMESTAMP_X",
                    25 => "MODIFIED_BY",
                    26 => "USER_NAME",
                    27 => "",
                ),
                "FILTER_PROPERTY_CODE" => array(
                    0 => "IS_ONLINE",
                    1 => "IS_POPULAR",
                    2 => "IS_FEDERAL",
                    3 => "",
                ),
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "",
                "SORT_ORDER2" => "",
                "CHECK_DATES" => "Y",
                "SEF_MODE" => "Y",
                "SEF_FOLDER" => "/offers/",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "Y",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => "36000000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_TITLE" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "ADD_ELEMENT_CHAIN" => "N",
                "USE_PERMISSIONS" => "N",
                "STRICT_SECTION_CHECK" => "N",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "USE_SHARE" => "N",
                "PREVIEW_TRUNCATE_LEN" => "",
                "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                "LIST_FIELD_CODE" => array(
                    0 => "ID",
                    1 => "CODE",
                    2 => "XML_ID",
                    3 => "NAME",
                    4 => "TAGS",
                    5 => "SORT",
                    6 => "PREVIEW_TEXT",
                    7 => "PREVIEW_PICTURE",
                    8 => "DETAIL_TEXT",
                    9 => "DETAIL_PICTURE",
                    10 => "DATE_ACTIVE_FROM",
                    11 => "ACTIVE_FROM",
                    12 => "DATE_ACTIVE_TO",
                    13 => "ACTIVE_TO",
                    14 => "SHOW_COUNTER",
                    15 => "SHOW_COUNTER_START",
                    16 => "IBLOCK_TYPE_ID",
                    17 => "IBLOCK_ID",
                    18 => "IBLOCK_CODE",
                    19 => "IBLOCK_NAME",
                    20 => "IBLOCK_EXTERNAL_ID",
                    21 => "DATE_CREATE",
                    22 => "CREATED_BY",
                    23 => "CREATED_USER_NAME",
                    24 => "TIMESTAMP_X",
                    25 => "MODIFIED_BY",
                    26 => "USER_NAME",
                    27 => "",
                ),
                "LIST_PROPERTY_CODE" => array(
                    0 => "IS_ONLINE",
                    1 => "IS_POPULAR",
                    2 => "IS_FEDERAL",
                    3 => "CHARGE_PERCENT",
                    4 => "CHARGE_OFFERS",
                    5 => "ACCEPT_PERCENT",
                    6 => "ACCEPT_OFFERS",
                ),
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "DISPLAY_NAME" => "Y",
                "META_KEYWORDS" => "-",
                "META_DESCRIPTION" => "-",
                "BROWSER_TITLE" => "-",
                "DETAIL_SET_CANONICAL_URL" => "N",
                "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                "DETAIL_FIELD_CODE" => array(
                    0 => "ID",
                    1 => "CODE",
                    2 => "XML_ID",
                    3 => "NAME",
                    4 => "TAGS",
                    5 => "SORT",
                    6 => "PREVIEW_TEXT",
                    7 => "PREVIEW_PICTURE",
                    8 => "DETAIL_TEXT",
                    9 => "DETAIL_PICTURE",
                    10 => "DATE_ACTIVE_FROM",
                    11 => "ACTIVE_FROM",
                    12 => "DATE_ACTIVE_TO",
                    13 => "ACTIVE_TO",
                    14 => "SHOW_COUNTER",
                    15 => "SHOW_COUNTER_START",
                    16 => "IBLOCK_TYPE_ID",
                    17 => "IBLOCK_ID",
                    18 => "IBLOCK_CODE",
                    19 => "IBLOCK_NAME",
                    20 => "IBLOCK_EXTERNAL_ID",
                    21 => "DATE_CREATE",
                    22 => "CREATED_BY",
                    23 => "CREATED_USER_NAME",
                    24 => "TIMESTAMP_X",
                    25 => "MODIFIED_BY",
                    26 => "USER_NAME",
                    27 => "",
                ),
                "DETAIL_PROPERTY_CODE" => array(
                    0 => "IS_ONLINE",
                    1 => "IS_POPULAR",
                    2 => "IS_FEDERAL",
                    3 => "CHARGE_PERCENT",
                    4 => "CHARGE_OFFERS",
                    5 => "ACCEPT_PERCENT",
                    6 => "ACCEPT_OFFERS",
                ),
                "DETAIL_DISPLAY_TOP_PAGER" => "N",
                "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                "DETAIL_PAGER_TITLE" => "Страница",
                "DETAIL_PAGER_TEMPLATE" => "",
                "DETAIL_PAGER_SHOW_ALL" => "N",
                "PAGER_TEMPLATE" => "offers.ajax",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "N",
                "FILE_404" => "",
                "FIELD_CODE" => array(
                    0 => "ID",
                    1 => "CODE",
                    2 => "XML_ID",
                    3 => "NAME",
                    4 => "TAGS",
                    5 => "SORT",
                    6 => "PREVIEW_TEXT",
                    7 => "PREVIEW_PICTURE",
                    8 => "DETAIL_TEXT",
                    9 => "DETAIL_PICTURE",
                    10 => "DATE_ACTIVE_FROM",
                    11 => "ACTIVE_FROM",
                    12 => "DATE_ACTIVE_TO",
                    13 => "ACTIVE_TO",
                    14 => "SHOW_COUNTER",
                    15 => "SHOW_COUNTER_START",
                    16 => "IBLOCK_TYPE_ID",
                    17 => "IBLOCK_ID",
                    18 => "IBLOCK_CODE",
                    19 => "IBLOCK_NAME",
                    20 => "IBLOCK_EXTERNAL_ID",
                    21 => "DATE_CREATE",
                    22 => "CREATED_BY",
                    23 => "CREATED_USER_NAME",
                    24 => "TIMESTAMP_X",
                    25 => "MODIFIED_BY",
                    26 => "USER_NAME",
                    27 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "CHARGE_PERCENT",
                    1 => "ACCEPT_PERCENT",
                    2 => "IS_ONLINE",
                    3 => "IS_POPULAR",
                    4 => "IS_FEDERAL",
                    5 => "",
                ),
                "DETAIL_URL" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "additionalResult" => $arResult,
            ),
            $this
        );
        ?>
    </div>
</main>

<div id="partner-addresses" class="modal mfp-hide">
    <div class="modal__inner">
        <div class="modal__dismiss-box">
            <a class="modal__dismiss" href="javascript: void(0);">❌</a>
        </div>
        <div class="title title__modal">
            <div class="title__inner">
                <h3>Адреса магазинов</h3>
            </div>
        </div>
        <div class="map map--box map--list map--box-large map__addresses">
            <div id="map-addresses" class="map__inner"></div>
            <div class="map__list-box">
                <div class="title title__map-list">
                    <h4>Адреса магазинов:</h4>
                </div>
                <ul class="map__list"></ul>
            </div>
        </div>

    </div>
</div>
<script>
    shops = <?= json_encode($arResult['addresses'] ?: [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_LINE_TERMINATORS | JSON_UNESCAPED_UNICODE) ?>;
</script>
