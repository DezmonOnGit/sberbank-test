<? if ($arResult['record_left'] > 0): ?>
    <div class="offers__btns container">
        <a href="javascript:void(0)" class="button button--theme-green button__offers"><?php \Extyl\Spasibo\Partners\Tools\Lang::getNumericString(
            $arResult['record_left'], [
                'Ещё {val} предложение',
                'Ещё {val} предложения',
                'Ещё {val} предложениий',
            ]
        )?></a>
    </div>
<? endif; ?>
<script>
    Extyl.offersPager.current_page = 1;
    Extyl.offersPager.init();
</script>