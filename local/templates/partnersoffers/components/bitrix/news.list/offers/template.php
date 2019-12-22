<div class="title title--center title__offers">
    <div class="title__inner container">
        <h2><?= $arResult['NAV_RESULT']->nSelectedCount ?> предложения в категории «<?= $arResult['filter']['category']['name'] ?>»</h2>
    </div>
</div>
<div class="offers__inner container cards">
    <div class="cards__inner" <?= \Extyl\Spasibo\Partners\Main\Page\AjaxTool::setTags('offers-list-list') ?>>
        <? \Extyl\Spasibo\Partners\Main\Page\AjaxTool::startArea() ?>
        <? foreach ($arResult['ITEMS'] as $item): ?>
        <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="cards__item">
            <div class="cards__img-box">
                <img class="cards__img" src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="offers-1">
            </div>
            <div class="cards__info">
                <div class="cards__img-box">
                    <img class="cards__img rounded" src="<?= $item['PARTNER']['PREVIEW_PICTURE']['SRC'] ?>" alt="cards-5">
                </div>
                <div class="cards__name"><?= $item['PARTNER']['NAME'] ?></div>
                <div class="cards__text"><?= $item['NAME'] ?></div>
            </div>
        </a>
        <? endforeach; ?>
        <? \Extyl\Spasibo\Partners\Main\Page\AjaxTool::endArea() ?>
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>