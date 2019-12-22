<? if ($arResult['record_left'] > 0): ?>
    <div class="partners__btns container">
        <a href="javascript:void(0)" class="button button--theme-green button__partners"><?php \Extyl\Spasibo\Partners\Tools\Lang::getNumericString(
            $arResult['record_left'], [
                'Ещё {val} партнёр',
                'Ещё {val} партнёра',
                'Ещё {val} партнёров'
            ]
        )?></a>
    </div>
<? endif; ?>
<script>
    Extyl.partnersPager.current_page = 1;
    Extyl.partnersPager.init();
</script>