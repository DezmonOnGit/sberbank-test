</div>
</main>

<footer class="footer">
    <div class="footer__inner container">
        <div class="footer__row">
            <div class="footer__phone footer__left">
                <a href="tel:900" class="footer__phoneLink">900</a>
                <span class="footer__phoneInfo">По России бесплатно</span>
            </div>
            <nav class="menu menu__footer">
                <div class="menu__item menu__item--disabled">
                    <a href="#" class="menu__link link">Правила программы</a>
                </div>
                <div class="menu__item menu__item--disabled">
                    <a href="#" class="menu__link link">Стать партнером</a>
                </div>
                <div class="menu__item menu__item--disabled">
                    <a href="#" class="menu__link link">Архив акций</a>
                </div>
                <div class="menu__item menu__item--disabled">
                    <a href="#" class="menu__link link">Новости</a>
                </div>
                <div class="menu__item menu__item--disabled">
                    <a href="#" class="menu__link link">Вопросы и ответы</a>
                </div>
                <div class="menu__item menu__item--disabled">
                    <a href="#" class="menu__link link">Обратная связь</a>
                </div>
            </nav>
        </div>
        <div class="footer__row">
            <div class="footer__left"></div>
            <div class="footer__apps">
                <div class="footer__app">
                    <img src="/assets/img/android-download.png" alt="Spasibo Sberbank app for android" class="footer__appImg">
                </div>
                <div class="footer__app">
                    <img src="/assets/img/iphone-download.png" alt="Spasibo Sberbank app for iPhone" class="footer__appImg">
                </div>
            </div>
            <div class="footer__socs">
                <a href="https://ok.ru/spasibosb" class="footer__soc">
                    <img src="/assets/img/odnoklassniki.png" alt="Spasibo Sberbank odnoklassniki" class="footer__socImg">
                </a>
                <a href="https://www.facebook.com/spasibosb" class="footer__soc">
                    <img src="/assets/img/facebook.png" alt="Spasibo Sberbank facebook" class="footer__socImg">
                </a>
                <a href="https://vk.com/spasibosb" class="footer__soc">
                    <img src="/assets/img/vk.png" alt="Spasibo Sberbank vkontakte" class="footer__socImg">
                </a>
                <a href="https://www.instagram.com/spasibosb/" class="footer__soc">
                    <img src="/assets/img/instagram.png" alt="Spasibo Sberbank instagramm" class="footer__socImg">
                </a>
            </div>
        </div>
        <div class="footer__row">
            <div class="footer__copyright footer__left">
                &copy; 1997 — <?= date('Y') ?>
                <br>
                ПАО Сбербанк
            </div>
            <div class="footer__disclaimer">
                <a href="/policy.pdf" target="_blank" class="footer__disclaimerLink">Политика</a> АО «ЦПЛ» в отношении обработки персональных данных и
                <a href="/agreement.pdf" target="_blank" class="footer__disclaimerLink">Согласие</a> на обработку данных участника Программы «Спасибо от Сбербанка»
            </div>
        </div>
    </div>
</footer>

<? $APPLICATION->IncludeComponent('extyl:city.chooser', '') ?>

<script src="/assets/js/jquery-3.4.1.min.js"></script>
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/custom.js"></script>

<script src="https://api-maps.yandex.ru/2.1/?apikey=a1931c95-89dc-4a31-8a1d-53f34c152789&load=package.full&lang=ru_RU" type="text/javascript"></script>
<!--<script src="/assets/js/map.js"></script>-->
<script src="/assets/js/magnific-popup.min.js"></script>

</body>
</html>