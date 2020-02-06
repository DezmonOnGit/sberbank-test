<? if ($arResult['ITEMS']): ?>
    <div class="title title__offers">
        <div class="title__inner container container--small">
            <h3><?= \Extyl\Spasibo\Partners\Tools\Lang::getNumericString(
                $arResult['NAV_RESULT']->nSelectedCount,
                [
                    '{val} предложение',
                    '{val} предложения',
                    '{val} предложений',
                ]
            ) ?></h3>
        </div>
    </div>
    <div class="tabs tabs__offers">
        <div class="offers__inner container container--small cards cards--small-img">
            <div class="cards__inner" <?= \Extyl\Spasibo\Partners\Main\Page\AjaxTool::setTags('offers-list-list') ?>>
                <? \Extyl\Spasibo\Partners\Main\Page\AjaxTool::startArea() ?>
                <? foreach ($arResult['ITEMS'] as $item): ?>
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="cards__item" data-cards-in-row="2">
                    <div class="cards__img-box">
                        <img class="cards__img" src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="offers-1">
                    </div>
                    <div class="cards__info cards__info--full">
                        <div class="cards__text cards__description"><?= $item['NAME'] ?></div>
                    </div>
                </a>
                <? endforeach ?>
                <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                    <br /><?= $arResult["NAV_STRING"] ?>
                <?endif;?>
                <? \Extyl\Spasibo\Partners\Main\Page\AjaxTool::endArea() ?>
            </div>
        </div>
    </div>
<? endif;