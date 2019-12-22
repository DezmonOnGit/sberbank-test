$(function () {

    //search
    if($('.search').length) {
        var search = {};
        search.wrapper = $('.search');
        search.header = search.wrapper.closest('.header');
        search.btnOpener = search.wrapper.find('.search__btn--opener');
        search.inner = search.wrapper.find('.search__inner');

        search.calcInnerOffset = function() {
            if(search.header.length) {
                search.inner.css({
                    top: search.header.innerHeight(),
                });
            }
        };

        search.showInner = function() {
            search.inner.slideDown();
            search.inner.addClass('search__inner--open');
        };

        search.hideInner = function() {
            search.inner.slideUp(function () {
                search.inner.removeClass('search__inner--open');
            });
        };

        search.init = function() {
            search.calcInnerOffset();

            $(window).resize(function () {
                search.calcInnerOffset();
            });

            search.btnOpener.on('click', function () {
                if(search.inner.hasClass('search__inner--open')) {
                    search.hideInner();
                } else {
                    search.showInner();
                }
            });
        };

        search.init();
    };


    //modals
    if($('.modal').length) {
        $('.link--modal-opener').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#username',
            modal: true
        });

        $(document).on('click', '.modal__dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });
    };

    //user city
    if($('.user__city').length) {
       $(document).on('click', '.user__city .bar__balloon .button__accept', function () {
          var self = $(this);
          var wrapper = self.closest('.user__city');

           wrapper.removeClass('balloon--opened');
       });

       //balloon
        var balloonOpener = $('.user__city').find('.balloon__opener');
        var ballonCityBtn = $('.user__city').find('.button__change');

        balloonOpener.on('click', toggleBallon);
        ballonCityBtn.on('click', toggleBallon);
    };

    //tabs
    if($('.tabs').length) {

        $(document).on('click', '.button__tabs-nav', function () {
            var self = $(this);
            var selfIndex = self.attr('data-tab-index');
            var wrapper = self.closest('.tabs');
            var nav = wrapper.find('.tabs__nav');
            var btnNavActive = nav.find('.button--active');
            var contentBox = wrapper.find('.tabs__content');
            var contentActive = contentBox.find('.tabs__item--active');
            var contentNext = contentBox.find('[data-tab-index="' + selfIndex + '"]');

            if(!self.hasClass('button--active')) {
                btnNavActive.removeClass('button--active');
                self.addClass('button--active');

                contentActive.slideUp(function () {
                    contentActive.removeClass('tabs__item--active');
                    contentNext.slideDown().addClass('tabs__item--active');
                });
            }
        });
    };

    //burger
    if($('.button__burger').length) {
        //inner
        var burger = {};
        burger.header = $('.header');
        burger.button = burger.header.find('.button__burger');
        burger.menu = burger.header.find('.menu__header');
        burger.menuBox = burger.menu.closest('.header__menu');

        burger.showMenu = function () {
            burger.button.addClass('button__burger--open');
            burger.menuBox.addClass('header__menu--opened');
            $('body').addClass('scroll-blocked');
        };

        burger.hideMenu = function () {
            burger.button.removeClass('button__burger--open');
            burger.menuBox.removeClass('header__menu--opened');
            $('body').removeClass('scroll-blocked');
        };

        burger.initMenu = function() {
            if($(window).innerWidth() <= 1023) {
                burger.menuBox.css({
                    top: burger.header.innerHeight(),
                    height: $(window).innerHeight() - burger.header.innerHeight(),
                });
            } else {
                burger.menuBox.css({
                    top: '',
                    height: '',
                });
            }
        };

        burger.toggleMenu = function () {
            if(burger.button.hasClass('button__burger--open')) {
                burger.hideMenu();
            } else {
                burger.showMenu();
            }
        };

        burger.init = function () {
            burger.initMenu();

            burger.button.on('click', burger.toggleMenu);

            $(window).resize(function () {
                burger.initMenu();
            });
        };

        //outer
        burger.init();
    }

});

function toggleBallon() {
    var balloonOpener = $(this);
    var wrapper = balloonOpener.closest('.user__city');

    if(wrapper.hasClass('balloon--opened')) {
        wrapper.removeClass('balloon--opened');
    } else {
        wrapper.addClass('balloon--opened');
    }
}