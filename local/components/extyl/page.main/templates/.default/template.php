<?php
/** @var \CBitrixComponentTemplate $this */
dump($arResult);
use Extyl\Spasibo\Partners\Main\Filter; ?>
<div class="main__item partners partners--offsets">
    <?php
    $APPLICATION->IncludeComponent(
	"bitrix:catalog.filter", 
	"partners", 
	array(
		"COMPONENT_TEMPLATE" => "partners",
		"IBLOCK_TYPE" => "partnersoffers",
		"IBLOCK_ID" => "3",
		"PREFILTER_NAME" => "preFilter",
		"FILTER_NAME" => "partnersFilter",
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
			27 => "SECTION_ID",
			28 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "IS_ONLINE",
			2 => "IS_POPULAR",
			3 => "IS_FEDERAL",
			4 => "",
		),
		"LIST_HEIGHT" => "5",
		"TEXT_WIDTH" => "20",
		"NUMBER_WIDTH" => "5",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SAVE_IN_SESSION" => "N",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PRICE_CODE" => array(
		)
	),
	$this
);
    ?>
    <div class="partners__inner cards" <?= \Extyl\Spasibo\Partners\Main\Page\AjaxTool::setTags('partners-list', 'main') ?>>
    <?php
    \Extyl\Spasibo\Partners\Main\Page\AjaxTool::startArea();
    $a = $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"partners", 
	array(
		"COMPONENT_TEMPLATE" => "partners",
		"IBLOCK_TYPE" => "partnersoffers",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "4",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "partnersFilter",
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
		"SORT_BY1" => Filter::getCategory()===Filter::CAT_POPULAR?"PROPERTY_IS_POPULAR":"SORT",
		"SORT_ORDER1" => Filter::getCategory()===Filter::CAT_POPULAR?"DESC":"ASC",
		"SORT_BY2" => Filter::getCategory()===Filter::CAT_POPULAR?"SHOW_COUNTER":"SHOW_COUNTER",
		"SORT_ORDER2" => Filter::getCategory()===Filter::CAT_POPULAR?"DESC":"DESC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/partners/",
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
		"PAGER_TEMPLATE" => "partners.ajax",
//		"PAGER_TEMPLATE" => ".default",
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
	),
	$this
);
    \Extyl\Spasibo\Partners\Main\Page\AjaxTool::endArea();
    ?>
    </div>
</div>
<div class="main__item offers offers--offsets"<?= \Extyl\Spasibo\Partners\Main\Page\AjaxTool::setTags('offers-list', 'main') ?>>
    <? \Extyl\Spasibo\Partners\Main\Page\AjaxTool::startArea();

    $a = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "offers",
        array(
            "COMPONENT_TEMPLATE" => "partners",
            "IBLOCK_TYPE" => "partnersoffers",
            "IBLOCK_ID" => "5",
            "NEWS_COUNT" => "3",
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
            "SORT_BY1" => Filter::getCategory()===Filter::CAT_POPULAR?"PROPERTY_IS_POPULAR":"SORT",
            "SORT_ORDER1" => Filter::getCategory()===Filter::CAT_POPULAR?"DESC":"ASC",
            "SORT_BY2" => Filter::getCategory()===Filter::CAT_POPULAR?"SHOW_COUNTER":"SHOW_COUNTER",
            "SORT_ORDER2" => Filter::getCategory()===Filter::CAT_POPULAR?"DESC":"DESC",
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
     \Extyl\Spasibo\Partners\Main\Page\AjaxTool::endArea(); ?>
</div>
<div class="main__item collections">
    <div class="collections__inner container">
        <div class="collections__box collections__box--large">
            <a href="" class="collections__list">
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-1.png" alt="collections-1">
                    </div>
                    <div class="collections__discount">5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-2.png" alt="collections-2">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-3.png" alt="collections-3">
                    </div>
                    <div class="collections__discount">2.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-4.png" alt="collections-4">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-5.png" alt="collections-5">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
            </a>
            <div class="collections__name">
                <div class="collections__name-text">Скидки за бонусы</div>
            </div>
        </div>
        <div class="collections__row">
            <div class="collections__box">
                <a href="" class="collections__list">
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-6.png" alt="collections-6">
                        </div>
                        <div class="collections__discount">5%</div>
                    </div>
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-2.png" alt="collections-7">
                        </div>
                        <div class="collections__discount">1.5%</div>
                    </div>
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-7.png" alt="collections-8">
                        </div>
                        <div class="collections__discount">2.5%</div>
                    </div>
                </a>
                <div class="collections__name">
                    <div class="collections__name-text">Большой % начисления</div>
                </div>
            </div>
            <div class="collections__box">
                <a href="" class="collections__list">
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-8.png" alt="collections-9">
                        </div>
                        <div class="collections__discount">5%</div>
                    </div>
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-9.png" alt="collections-10">
                        </div>
                        <div class="collections__discount">1.5%</div>
                    </div>
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-10.png" alt="collections-11">
                        </div>
                        <div class="collections__discount">2.5%</div>
                    </div>
                </a>
                <div class="collections__name">
                    <div class="collections__name-text">Выгодные купоны</div>
                </div>
            </div>
        </div>
        <div class="collections__box collections__box--large">
            <a href="" class="collections__list">
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-11.png" alt="collections-12">
                    </div>
                    <div class="collections__discount">5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-12.png" alt="collections-13">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-13.png" alt="collections-14">
                    </div>
                    <div class="collections__discount">2.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-14.png" alt="collections-15">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-15.png" alt="collections-15">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
            </a>
            <div class="collections__name">
                <div class="collections__name-text">Персональное исходя из трат</div>
            </div>
        </div>
    </div>
</div>