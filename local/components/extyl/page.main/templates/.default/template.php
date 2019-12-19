<?php
/** @var \CBitrixComponentTemplate $this */
?>
<div class="main__item partners partners--offsets">
    <div class="filter filter--offsets">
        <div class="filter__inner container">
            <div class="filter__item">
                <button class="button button--theme-white" type="button">Все партнеры</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white" type="button">Популярные</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white" type="button">Супермаркеты</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white" type="button">Кафе и рестораны</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white" type="button">Такси</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white" type="button">Красота</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white button--active" type="button">Электроника и бытовая техника</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white" type="button">Зоотовары</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white" type="button">Кино и театр</button>
            </div>
            <div class="filter__item">
                <button class="button button--theme-white button__more" type="button">• • •</button>
            </div>
        </div>
    </div>
    <div class="switcher switcher--offsets switcher__filter">
        <div class="switcher__inner container">
            <div class="input-box input-box__switcher switcher__items">
                <input id="switcher-1" class="input input__checkbox" type="checkbox">
                <label class="switcher__item switcher__item--order-2 input__switcher" for="switcher-1"></label>
                <div class="switcher__item switcher__item--order-1 switcher__text">Начисляют спасибо</div>
                <div class="switcher__item switcher__item--order-3 switcher__text">Принимают спасибо</div>
            </div>
        </div>
    </div>
    <div class="partners__inner cards">
    <?php
    $APPLICATION->IncludeComponent('bitrix:news', '.default', [], $this);
    ?>
    </div>
</div>
<div class="main__item offers offers--offsets">
    <div class="title title--center title__offers">
        <div class="title__inner container">
            <h2>3 предложения в категории «Электроника и бытовая техника»</h2>
        </div>
    </div>
    <div class="offers__inner container cards">
        <div class="cards__inner">
            <a href="" class="cards__item">
                <div class="cards__img-box">
                    <img class="cards__img" src="assets/img/offers-1.jpeg" alt="offers-1">
                </div>
                <div class="cards__info">
                    <div class="cards__img-box">
                        <img class="cards__img" src="assets/img/cards-5.png" alt="cards-5">
                    </div>
                    <div class="cards__name">Технопарк</div>
                    <div class="cards__text">20% спасибо за технику Electrolux</div>
                </div>
            </a>
            <a href="" class="cards__item">
                <div class="cards__img-box">
                    <img class="cards__img" src="assets/img/offers-2.jpeg" alt="offers-2">
                </div>
                <div class="cards__info">
                    <div class="cards__img-box">
                        <img class="cards__img" src="assets/img/cards-4.png" alt="cards-4">
                    </div>
                    <div class="cards__name">Евросеть</div>
                    <div class="cards__text">10% спасибо за покупки в черную пятницу</div>
                </div>
            </a>
            <a href="" class="cards__item">
                <div class="cards__img-box">
                    <img class="cards__img" src="assets/img/offers-3.jpeg" alt="offers-3">
                </div>
                <div class="cards__info">
                    <div class="cards__img-box">
                        <img class="cards__img" src="assets/img/cards-1.png" alt="cards-1">
                    </div>
                    <div class="cards__name">М.Видео</div>
                    <div class="cards__text">15% спасибо для студентов</div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="main__item collections">
    <div class="collections__inner container">
        <div class="collections__box collections__box--large">
            <a href="" class="collections__list">
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-1.png" alt="collections-1">
                    </div>
                    <div class="collections__discount">5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-2.png" alt="collections-2">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-3.png" alt="collections-3">
                    </div>
                    <div class="collections__discount">2.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-4.png" alt="collections-4">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-5.png" alt="collections-5">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
            </a>
            <div class="collections__name">
                <div class="collections__name-text">Скидки за бонусы</div>
            </div>
        </div>
        <div class="collections__row">
            <div class="collections__box">
                <a href="" class="collections__list">
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-6.png" alt="collections-6">
                        </div>
                        <div class="collections__discount">5%</div>
                    </div>
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-2.png" alt="collections-7">
                        </div>
                        <div class="collections__discount">1.5%</div>
                    </div>
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-7.png" alt="collections-8">
                        </div>
                        <div class="collections__discount">2.5%</div>
                    </div>
                </a>
                <div class="collections__name">
                    <div class="collections__name-text">Большой % начисления</div>
                </div>
            </div>
            <div class="collections__box">
                <a href="" class="collections__list">
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-8.png" alt="collections-9">
                        </div>
                        <div class="collections__discount">5%</div>
                    </div>
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-9.png" alt="collections-10">
                        </div>
                        <div class="collections__discount">1.5%</div>
                    </div>
                    <div class="collections__item">
                        <div class="collections__img-box">
                            <img class="collections__img" src="assets/img/collections-10.png" alt="collections-11">
                        </div>
                        <div class="collections__discount">2.5%</div>
                    </div>
                </a>
                <div class="collections__name">
                    <div class="collections__name-text">Выгодные купоны</div>
                </div>
            </div>
        </div>
        <div class="collections__box collections__box--large">
            <a href="" class="collections__list">
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-11.png" alt="collections-12">
                    </div>
                    <div class="collections__discount">5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-12.png" alt="collections-13">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-13.png" alt="collections-14">
                    </div>
                    <div class="collections__discount">2.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-14.png" alt="collections-15">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
                <div class="collections__item">
                    <div class="collections__img-box">
                        <img class="collections__img" src="assets/img/collections-15.png" alt="collections-15">
                    </div>
                    <div class="collections__discount">1.5%</div>
                </div>
            </a>
            <div class="collections__name">
                <div class="collections__name-text">Персональное исходя из трат</div>
            </div>
        </div>
    </div>
</div>
