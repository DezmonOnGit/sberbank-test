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
    }


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
    }

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