$(function () {
    if($('.select').length) {
        $('.select').styler();
    }


    //menu
    if($('.js-menu-header').length) {

        //при загрузке страницы
        initHeaderMenu();

        // при ресайзе
        $(window).resize(function () {
            initHeaderMenu();
        });
    }

    if($('.menu__item-inner').length) {
        $('.menu__item-inner .menu__link').on('click', function (e) {
            var self = $(this);
            var box = self.closest('.menu__item-inner');
            var subMenu = box.find('.menu__submenu');
            var menu = self.closest('.menu');

            if(subMenu.length) {
                e.preventDefault();
                e.stopPropagation();

                if (subMenu.hasClass('opened')) {
                    subMenu.slideUp();
                    subMenu.removeClass('opened');
                } else {
                    subMenu.slideDown();
                    subMenu.addClass('opened');
                }
            }
        });

        //при загрзке страницы
        if($(window).innerWidth() <= 1024) {
            toggleMenuInnerHover(false);
        } else {
            toggleMenuInnerHover(true);
        }
        //при ресайзе
        $(window).resize(function () {
            if($(window).innerWidth() <= 1024) {
                toggleMenuInnerHover(false);
            } else {
                toggleMenuInnerHover(true);
            }
        });
    }

    //sliders
    if($('.owl-carousel').length) {

        var sliderDefaultOptions = {
            items : 1,
            nav: true,
            smartSpeed: 700,
            navText: [makeSliderArrow('arrow-prev'),makeSliderArrow('arrow-next')],
        };

        var sliderCardsOptions = {
            items : 4,
            nav: true,
            smartSpeed: 700,
            margin: 27,
            navText: [makeSliderArrow('arrow-prev'),makeSliderArrow('arrow-next')],
            responsive: {
                0: {
                    autoWidth: true,
                    items : 1,
                    nav: false,
                    margin: 0,
                },
                768: {
                    autoWidth: true,
                    nav: false,
                    margin: 0,
                },
                1023: {
                    autoWidth: true,
                    nav: false,
                    margin: 0,
                }
            }
        };

        var sliderCommentsOptions = {
            items : 3,
            nav: true,
            smartSpeed: 700,
            margin: 133,
            navText: [makeSliderArrow('arrow-prev'),makeSliderArrow('arrow-next')],
            responsive: {
                0: {
                    autoWidth: true,
                    nav: false,
                    margin: 0,
                },
                1024: {
                    autoWidth: false,
                    nav: true,
                    margin: 133,
                }
            }
        };

        var sliderSitesOptions = {
            items : 4,
            nav: false,
            smartSpeed: 700,
            margin: 14,
            navText: [makeSliderArrow('arrow-prev'),makeSliderArrow('arrow-next')],
            responsive: {
                0: {
                    autoWidth: true,
                    nav: false,
                    margin: 0,
                },
                1024: {
                    autoWidth: false,
                    nav: false,
                    margin: 14,
                }
            }
        };

        var sliderVideoOptions = {
            items : 1,
            nav: true,
            smartSpeed: 700,
            navText: [makeSliderArrow('arrow-prev'),makeSliderArrow('arrow-next')],
            responsive: {
                0: {
                    autoWidth: true,
                    nav: false,
                },
                1024: {
                    autoWidth: false,
                    nav: true,
                }
            }
        };

        var sliderPhotoOptions = {
            items : 1,
            nav: true,
            smartSpeed: 700,
            navText: [makeSliderArrow('arrow-prev'),makeSliderArrow('arrow-next')],
            responsive: {
                0: {
                    autoWidth: true,
                    nav: false,
                },
                1024: {
                    autoWidth: false,
                    nav: false,
                }
            }
        };

        var sliderCommitteesOptions = {
            items : 1,
            nav: true,
            smartSpeed: 700,
            navText: [makeSliderArrow('arrow-prev'),makeSliderArrow('arrow-next')],
            responsive: {
                0: {
                    autoWidth: false,
                    nav: false,
                },
                1024: {
                    autoWidth: false,
                    nav: true,
                }
            }
        };

        var sliderPhoto = {};
        sliderPhoto.self =  $('.slider__photo');
        sliderPhoto.initSlides = sliderPhoto.self.find('.slider__item').clone();
        sliderPhoto.allItems = sliderPhoto.self.find('.photo__item');
        sliderPhoto.transformSlides = function(mobile) {
            this.self.trigger('destroy.owl.carousel');
            this.self.children().remove();

            if(mobile) {
                this.allItems.each(function (index, item) {
                    var sliderItem = $(item).wrap('<div class="slider__item">');
                    sliderPhoto.self.append(sliderItem);
                });
            } else {
                this.self.append(this.initSlides);
            }

            this.self.owlCarousel(sliderPhotoOptions);
        }

        $('.slider__main').owlCarousel(sliderDefaultOptions);
        $('.slider__cards').owlCarousel(sliderCardsOptions);
        $('.slider__video').owlCarousel(sliderVideoOptions);
        $('.slider__comments').owlCarousel(sliderCommentsOptions);
        $('.slider__committees').owlCarousel(sliderCommitteesOptions);
        $('.slider__sites').owlCarousel(sliderSitesOptions);

        //slider photo
        //при загрузке страницы
        if($(window).innerWidth() <= 1023) {
            sliderPhoto.transformSlides(true);
        } else {
            sliderPhoto.transformSlides(false);
        }

        //slider photo
        //при ресайзе
        $(window).resize(function () {
            if($(window).innerWidth() <= 1023) {
                sliderPhoto.transformSlides(true);
            } else {
                sliderPhoto.transformSlides(false);
            }
        });

    }
    
    //comments
    if($('.comments').length) {
        var comments = {};
        comments.box = $('.comments');
        comments.items = comments.box.find('.comments__item');
        comments.infos = comments.items.find('.comments__info');
        comments.texts = comments.items.find('.comments__text');
        comments.blockquotes = comments.items.find('.comments__blockquote');

        //при загрузке страницы
        setSameHeight(comments.texts);
        setSameHeight(comments.infos);

        //при ресайзе
        $(window).resize(function () {
            setSameHeight(comments.texts);
            setSameHeight(comments.infos);
        });

    }

    //acco
    if($('.acco').length) {

        $('.acco__link').on('click', function (e) {

            var self = $(this);
            var box = self.closest('.acco__item');
            var submenu = box.find('.acco__submenu');

            if(submenu.length) {
                e.preventDefault();
                e.stopPropagation();


                if (submenu.hasClass('opened')) {
                    submenu.slideUp();
                    submenu.removeClass('opened');
                } else {
                    submenu.slideDown();
                    submenu.addClass('opened');
                }
            }
        });
    }

    //burger
    if($('.burger').length) {
        $('.burger').on('click', function () {
            var self = $(this);
            var menu = $('.menu.header__bottom');
            var body = $('body');
            var header = $('.header');

            if(self.hasClass('active')) {
                menu.slideUp();
                menu.removeClass('opened');
                self.removeClass('active');
                body.removeClass('scroll-blocked');
                header.removeClass('active');
            } else {
                body.addClass('scroll-blocked');
                menu.slideDown();
                menu.addClass('opened');
                self.addClass('active');
                header.addClass('active');
            }
        });
    }

    //search
    if($('.search__opener').length) {
        $('.search__opener').on('click', function () {
           var self = $(this);
           var header = self.closest('.header');
           var headerSearch = header.find('.header__search-box');

           if(headerSearch.hasClass('opened')) {
               headerSearch.removeClass('opened');
           } else {
               headerSearch.addClass('opened');
           }
        });
    }

});


function initHeaderMenu() {

    setSubmenuOffsets($('.menu__item'));

}

function setSubmenuOffsets(menuItem) {
    var header = menuItem.closest('.header');
    var curSubmenu = menuItem.find('.menu__item-submenu');
    var offsetTop = header.innerHeight();

    curSubmenu.css({
        paddingTop: offsetTop,
    });
}

function makeSliderArrow(arrowClasses) {
    return  '<svg class="' + arrowClasses + '" width="12" height="20" viewBox="0 0 12 20" xmlns="http://www.w3.org/2000/svg">\n' +
                '<path fill-rule="evenodd" clip-rule="evenodd" d="M10.9428 1.05727C11.4635 1.57797 11.4635 2.42219 10.9428 2.94289L3.88558 10.0001L10.9428 17.0573C11.4635 17.578 11.4635 18.4222 10.9428 18.9429C10.4221 19.4636 9.57785 19.4636 9.05715 18.9429L1.05715 10.9429C0.536451 10.4222 0.536451 9.57797 1.05715 9.05727L9.05715 1.05727C9.57785 0.536573 10.4221 0.536573 10.9428 1.05727Z"/>\n' +
            '</svg>';
}

function setSameHeight(items) {
    var maxHeight = findMaxHeight(items);

    items.each(function (index, item) {
        $(item).css({
            height: maxHeight,
        });
    })
}

function findMaxHeight(items) {
    var maxHeight = 0;

    items.each(function (index, item) {
        $(item).css({
            height: 'auto',
        });

        if ($(item).outerHeight() > maxHeight) {
            maxHeight = $(item).outerHeight();
        }
    });

    return maxHeight;
}

function toggleMenuInnerHover(flag) {
    if(typeof flag === 'undefined') {
        flag = false;
    }

    var items = $('.menu__item-inner');

    if(flag) {
        items.addClass('menu__item-inner--hover-opener');
    } else {
        items.removeClass('menu__item-inner--hover-opener');
    }

}