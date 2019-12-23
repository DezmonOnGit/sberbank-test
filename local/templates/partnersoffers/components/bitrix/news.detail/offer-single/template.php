<?
bxApp()->SetPageProperty('title_class', 'display-none');
bxApp()->SetTitle($arResult['NAME']);
?>
<style>
    main.main {
        background: #FFFFFF;
    }
</style>
<main class="main">
    <div class="main__inner">
        <div class="main__item title title--center title__main">
            <div class="title__inner container">
                <h1 class="h1--narrow action__h1"><span class="h1--whiteBackground"><?= $arResult['NAME'] ?></span></h1>
            </div>
        </div>
        <div class="main__item action">
            <div class="action__inner container container--small container--noPadding">
                <div class="action__img-box">
                    <img class="action__img" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="action-1">
                </div>
                <? if ($arResult['PROPERTIES']['PERIOD']['VALUE']): ?>
                    <div class="action__period">
                        <?= $arResult['PROPERTIES']['PERIOD']['VALUE'] ?>
                    </div>
                <? endif; ?>
                <? if ( ! $arResult['PREVIEW_TEXT']):
                    $prc = explode('%', $arResult['NAME'], 2);
                    ?>
                    <div class="action__annonce">
                        <span class="action__percent"><?= count($prc) == 2 ? ($prc[0] . '%') : '' ?></span>
                        <span class="action__subtitle"><?= count($prc) == 2 ? $prc[1] : $prc[0] ?></span>
                    </div>
                <? else: ?>
                    <div class="action__annonce">
                        <span class="action__percent"></span>
                        <span class="action__subtitle"><?= htmlspecialchars_decode($arResult['PREVIEW_TEXT']); ?></span>
                    </div>
                <? endif; ?>
                <? if ($arResult['DETAIL_TEXT']): ?>
                    <div class="action__text">
                        <?= htmlspecialchars_decode($arResult['DETAIL_TEXT']); ?>
                    </div>
                <? endif; ?>
                <? if ($arResult['PROPERTIES']['RULES']['VALUE']['SRC']): ?>
                    <a href="<?= $arResult['PROPERTIES']['RULES']['VALUE']['SRC'] ?>" target="_blank" class="action__rules"><?= $arResult['PROPERTIES']['FILE_NAME']['VALUE'] ?: 'Правила акции' ?></a>
                <? endif; ?>
            </div>
        </div>
        <div class="main__item address">
            <div class="address__partner container container--small">
                <div class="map map--box map--list map--box-large map__addresses">
                    <div class="address__img-box">
                        <img class="address__img square_70 rounded" src="<?= $arResult['PARTNER']['PREVIEW_PICTURE']['SRC'] ?>" alt="partners-1">
                    </div>
                    <div class="map__list-box">
                        <div class="address__title"><?= $arResult['PARTNER']['NAME'] ?></div>
                        <div class="map__list">
                        </div>
                    </div>
                    <? if ($arResult['addresses']): ?>
                        <div class="map__wrapper">
                            <div id="map-action" class="map__inner"></div>
                            <div class="map__mask"></div>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    shops = <?= json_encode($arResult['addresses'] ?: [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_LINE_TERMINATORS | JSON_UNESCAPED_UNICODE) ?>;
</script>