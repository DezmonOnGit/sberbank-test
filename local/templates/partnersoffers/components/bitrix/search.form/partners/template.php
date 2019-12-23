<?php
/** @var \CBitrixComponentTemplate $this */
?>
<script>
    Extyl.SearchForm.SEARCH_AJAX_URL = '<?= $this->GetFolder() ?>/ajax.php';
</script>
<script type="text/html" id="search-result-card-template">
    <a href="{{ href }}" class="cards__item cards__info">
        <div class="cards__img-box">
            <img class="cards__img" src="{{ picture }}" alt="{{ name }}">
        </div>
        <div class="cards__name">{{ name }}</div>
    </a>
</script>
<div class="search__inner" style="top: 171px;">
    <div class="search__container container">
        <form action="" class="form form__search">
            <div class="input-box input-box--row">
                <input type="text" class="input input__search input__t-text">
                <button class="button button__select" type="submit">Поиск</button>
            </div>
        </form>
        <div class="search__result">
            <div class="cards cards--item-inner-row">
                <div class="cards__inner" data-role="search-result-area"></div>
            </div>
        </div>
    </div>
</div>
<script>Extyl.SearchForm.init()</script>