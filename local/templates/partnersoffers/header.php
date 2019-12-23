<!DOCTYPE html>
<html lang="ru">
<head>
    <?php bxApp()->ShowHead(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bxApp()->ShowTitle() ?></title>
<!--    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">-->
<!--    <link rel="stylesheet" href="/assets/css/bundle.css">-->
    <?php
        CJSCore::Init(['jquery']);

        Bitrix\Main\Page\Asset::getInstance()->addCss('/assets/css/owl.carousel.min.css');
        Bitrix\Main\Page\Asset::getInstance()->addCss('/assets/css/bundle.css');
        Bitrix\Main\Page\Asset::getInstance()->addCss('/assets/css/custom.css');
        Bitrix\Main\Page\Asset::getInstance()->addJs('/assets/js/extyl.js');
        Bitrix\Main\Page\Asset::getInstance()->addCss('/assets/css/magnific-popup.css');
    ?>
</head>
<body>
<? bxApp()->ShowPanel() ?>
<header class="header">
    <div class="header__inner container">
        <div class="header__row">
            <div class="user user__bonuses user--xs-mobile">
                <span class="user__count">95 <i class="icon icon--coin"></i></span>
            </div>
            <a href="/" class="logo logo--main logo__header">
                <img class="logo__img" src="/assets/img/logo.svg" alt="logo">
            </a>
            <div class="header__menu">
                <div class="bar bar__header-menu bar--mobile">
                    <div class="bar__item">
                        <div class="user user__bonuses">
                            <span class="user__count">95</span>
                            <span class="user__text">Бонусов</span>
                        </div>
                    </div>
                    <div class="bar__item">
                        <div class="user user__city user--xs-mobile">
                            <a href="#choose-city" class="link link--modal-opener"><i class="icon icon--mobile icon--mark-2"></i><?= \Extyl\Spasibo\Partners\Main\Filter::getCity() ?></a>
                        </div>
                    </div>
                    <div class="bar__item">
                        <a href="" class="link link__login link--disabled">Войти</a>
                    </div>
                </div>
                <nav class="menu menu__header">
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Купоны и сертификаты</a>
                    </div>
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Впечатления</a>
                    </div>
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Авиабилеты</a>
                    </div>
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Ж/д билеты</a>
                    </div>
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Отели</a>
                    </div>
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Каршеринг</a>
                    </div>
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Театры</a>
                    </div>
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Страхование</a>
                    </div>
                    <div class="menu__item menu__item--disabled">
                        <a href="#" class="menu__link link">Как подключиться</a>
                    </div>
                    <div class="menu__item menu__item--active">
                        <a href="/" class="menu__link link">Партнеры</a>
                    </div>
                </nav>
            </div>
            <div class="header__info">
                <div class="user user__bonuses">
                    <span class="user__count">95</span>
                    <span class="user__text">Бонусов</span>
                </div>
                <div class="user user__city balloon <?= \Extyl\Spasibo\Partners\Main\Filter::cityManualSet() ? '' : 'balloon--opened' ?>">
                    <div class="user__current-city balloon__opener"><i class="icon icon--mark"></i><i class="icon icon--mobile icon--mark-2"></i><?= \Extyl\Spasibo\Partners\Main\Filter::getCity() ?></div>
                    <div class="balloon__inner">
                        <div class="balloon__content">
                            <div class="title title__baloon">Ваш город</div>
                            <div class="balloon__city"><?= \Extyl\Spasibo\Partners\Main\Filter::getCity() ?></div>
                            <div class="bar bar__balloon">
                                <div class="bar__item">
                                    <button class="button button--theme-green button__accept" type="button" onclick="location.href='?user-city=<?= \Extyl\Spasibo\Partners\Main\Filter::getCity() ?>'">Да, все верно</button>
                                </div>
                                <div class="bar__item">
                                    <a href="#choose-city" class="button button__change link--modal-opener" type="button">Выбрать другой</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header__phone">
                    <i class="icon icon--mobile icon--phone"></i> <a class="link" href="tel:900">900</a> — по России бесплатно
                </div>
                <div class="header__btns">
                    <div class="search">
                        <div class="search__outer">
                            <a href="javascript: void(0);" class="search__btn search__btn--opener">
                                <i class="icon icon--search"></i>
                            </a>
                        </div>
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
                                        <div class="cards__inner">
                                            <a href="" class="cards__item cards__info">
                                                <div class="cards__img-box">
                                                    <img class="cards__img" src="assets/img/cards-1.png" alt="cards-1">
                                                </div>
                                                <div class="cards__name">М.Видео</div>
                                            </a>
                                            <a href="" class="cards__item cards__info">
                                                <div class="cards__img-box">
                                                    <img class="cards__img" src="assets/img/cards-2.png" alt="cards-2">
                                                </div>
                                                <div class="cards__name">Холодильник.ру</div>
                                            </a>
                                            <a href="" class="cards__item cards__info">
                                                <div class="cards__img-box">
                                                    <img class="cards__img" src="assets/img/cards-1.png" alt="cards-1">
                                                </div>
                                                <div class="cards__name">20% спасибо за технику Electrolux</div>
                                            </a>
                                            <a href="" class="cards__item cards__info">
                                                <div class="cards__img-box">
                                                    <img class="cards__img" src="assets/img/cards-2.png" alt="cards-2">
                                                </div>
                                                <div class="cards__name">20% спасибо за технику</div>
                                            </a>
                                            <a href="" class="cards__item cards__info">
                                                <div class="cards__img-box">
                                                    <img class="cards__img" src="assets/img/cards-1.png" alt="cards-1">
                                                </div>
                                                <div class="cards__name">М.Видео</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="" class="link link__login link--disabled">Войти</a>
                    <button class="button button__burger button--mobile" type="button">
                        <span class="button__burger-line"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<main class="main <? bxApp()->ShowProperty('main--offsets', 'main--offsets') ?>">
    <div class="main__inner main__inner--theme-night">
        <div class="main__item title title--center title__main">
            <div class="title__inner container">
<!--                --><?// if (in_array(bxApp()->GetCurPage(), ['/', '/offers/'])): ?>
                    <h1 class="<? bxApp()->ShowProperty('title_class') ?>"><?php bxApp()->ShowTitle() ?></h1>
<!--                --><?// endif; ?>
            </div>
        </div>
