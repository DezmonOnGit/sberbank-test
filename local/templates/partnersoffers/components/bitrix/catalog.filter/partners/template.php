<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

use Extyl\Spasibo\Partners\Main\Filter;
use Extyl\Spasibo\Partners\Main\Page\AjaxTool; ?>
<script type="text/html" id="button-template">
    <div class="filter__item" data-cat-i="{{cat-i}}" data-cat-id="{{cat-id}}">
        <button class="button button--theme-white {{button--active}}" data-cat-i="{{cat-i}}" data-cat-id="{{cat-id}}" type="button">{{cat-name}}</button>
    </div>
</script>
<script type="text/html" id="more-button-template">
    <div class="filter__item more-button" {{role}}>
        <button class="button button--theme-white" type="button">•••</button>
    </div>
</script>
<div <?= AjaxTool::setTags('partner-filter-cat') ?>>
<? AjaxTool::startArea() ?>
<div class="filter filter--offsets">
    <div class="filter__inner container">
        <div class="filter__item">
            <button class="button button--theme-white <?= (Filter::getCategory() === Filter::CAT_ALL) ? 'button--active' : '' ?>" data-cat-id="all" type="button">Все партнеры</button>
        </div>
        <div class="filter__item">
            <button class="button button--theme-white <?= (Filter::getCategory() === Filter::CAT_POPULAR) ? 'button--active' : '' ?>" data-cat-id="popular" type="button">Популярные</button>
        </div>
        <? foreach ($arResult['CATEGORIES'] as $k => $cat):
            if (Filter::getCategory() == $cat['ID']): ?>
                <div class="filter__item">
                    <button class="button button--theme-white <?= (Filter::getCategory() == $cat['ID']) ? 'button--active' : '' ?>" data-cat-id="<?= $cat['ID'] ?>" type="button"><?= $cat['NAME'] ?></button>
                </div>
                <? unset($arResult['CATEGORIES'][$k]);
            endif; ?>
        <? endforeach; ?>
    </div>
</div>
<div class="switcher switcher--offsets switcher__filter">
    <div class="switcher__inner container">
        <div class="input-box input-box__switcher switcher__items">
            <input id="switcher-1" class="input input__checkbox" type="checkbox" <?= Filter::getChargeAccept() === Filter::ACCEPT ? 'checked' : '' ?>>
            <label class="switcher__item switcher__item--order-2 input__switcher" for="switcher-1"></label>
            <div class="switcher__item switcher__item--order-1 switcher__text">Начисляют спасибо</div>
            <div class="switcher__item switcher__item--order-3 switcher__text">Принимают спасибо</div>
        </div>
    </div>
</div>
    <script>
        Extyl.PartnersFilter.current = {
            category: '<?= Filter::getCategory() ?>',
            chargeAccept: '<?= Filter::getChargeAccept() ?>',
        };
        Extyl.PartnersFilter.init(<?= json_encode(array_values($arResult['CATEGORIES']), JSON_UNESCAPED_UNICODE) ?>);
    </script>
    <? AjaxTool::endArea() ?>
</div>
