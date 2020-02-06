<? if ($arResult['record_left'] > 0): ?>
    <div class="partners__btns container">
        <a href="javascript:void(0)" class="button button--theme-green button__partners"><?= \Extyl\Spasibo\Partners\Tools\Lang::getNumericString(
            $arResult['record_left'], [
                'Ещё {val} партнёр',
                'Ещё {val} партнёра',
                'Ещё {val} партнёров'
            ]
        )?></a>
    </div>
<? endif; ?>
<script>
    Extyl.partnersPager.init();
</script>