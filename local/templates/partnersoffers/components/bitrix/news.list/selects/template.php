<? foreach ($arResult['ITEMS'] as $item): ?>
    <div class="collections__box collections__box--large">
        <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="collections__list">
            <? foreach ($item['PARTNERS'] as $partner): ?>
                <div class="collections__item" data-partner-name="<?= $partner['NAME'] ?>">
                    <div class="collections__img-box">
                        <img class="collections__img rounded" src="<?= $partner['PREVIEW_PICTURE']['SRC'] ?>" alt="collections-1">
                    </div>
                    <? if ($partner['PERCENT_TEXT']): ?>
                        <div class="collections__discount"><?= $partner['PERCENT_TEXT'] ?></div>
                    <? endif; ?>
                </div>
            <? endforeach; ?>
        </a>
        <div class="collections__name">
            <div class="collections__name-text"><?= $item['NAME'] ?></div>
        </div>
    </div>
<? endforeach;