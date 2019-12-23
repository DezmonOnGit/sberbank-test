if ( !!! window.top.Extyl) window.top.Extyl = {};

Extyl.partnersPager = {

    btn_selector: '.partners__btns.container .button__partners',
    container_selector: '.partners_inner .cards__inner.container',
    current_page: 1,

    init: function() {
        var self = Extyl.partnersPager;

        $(self.btn_selector)
            .off('click', self.loadNext)
            .on('click', self.loadNext)
        ;
    },
    loadNext: function() {
        var self = Extyl.partnersPager;

        $('.partners__btns').remove();

        Extyl.loadNext('partners-list', null, {
            PAGEN_1: ++self.current_page,
        });
    },
};
