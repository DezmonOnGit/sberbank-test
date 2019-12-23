<div class="offers__inner container cards">
    <div class="cards__inner">
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="cards__item" data-cards-in-row="2">
                <div class="cards__img-box">
                    <img class="cards__img" src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="offers-4">
                </div>
                <div class="cards__info">
                    <div class="cards__img-box">
                        <img class="cards__img rounded" src="<?= $item['PARTNER']['PREVIEW_PICTURE']['SRC'] ?>" alt="collections-7">
                    </div>
                    <div class="cards__name"><?= $item['PARTNER']['NAME'] ?></div>
                    <div class="cards__text"><?= $item['NAME'] ?></div>
                </div>
            </a>
        <? endforeach; ?>
    </div>
</div>
