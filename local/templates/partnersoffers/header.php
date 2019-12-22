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
        Bitrix\Main\Page\Asset::getInstance()->addJs('/assets/js/extyl.js');
    ?>
</head>
<body>
<? bxApp()->ShowPanel() ?>
<header class="header">
    <div class="header__inner container">
        <div class="header__row">
            <a href="#" class="logo logo--main logo__header">
                <img class="logo__img" src="/assets/img/logo.svg" alt="logo">
            </a>
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
            <div class="header__info">
                <div class="user user__bonuses">
                    <span class="user__count">95</span>
                    <span class="user__text">Бонусов</span>
                </div>
                <div class="user user__city balloon">
                    <div class="user__current-city balloon__opener"><i class="icon icon--mark"></i>Санкт-Петербург</div>
                    <div class="balloon__inner">
                        <div class="balloon__content">
                            <div class="title title__baloon">Ваш город</div>
                            <div class="balloon__city">Санкт-Петербург</div>
                            <div class="bar bar__balloon">
                                <div class="bar__item">
                                    <button class="button button--theme-green button__accept" type="button">Да, все верно</button>
                                </div>
                                <div class="bar__item">
                                    <button class="button button__change" type="button">Выбрать другой</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<main class="main main--offsets">
    <div class="main__inner main__inner--theme-night">
        <div class="main__item title title--center title__main">
            <div class="title__inner container">
                <h1><?php bxApp()->ShowTitle() ?></h1>
            </div>
        </div>
