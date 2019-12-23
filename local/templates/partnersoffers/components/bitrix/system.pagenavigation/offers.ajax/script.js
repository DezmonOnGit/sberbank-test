if ( !!! window.top.Extyl) window.top.Extyl = {};

Extyl.offersPager = {

    btn_selector: '.offers__btns.container .button__offers',
    container_selector: '.offers_inner .cards__inner.container',
    current_page: 1,

    init: function() {
        var self = Extyl.offersPager;

        $(self.btn_selector)
            .off('click', self.loadNext)
            .on('click', self.loadNext)
        ;
    },
    loadNext: function() {
        var self = Extyl.offersPager;

        $('.offers__btns').remove();

        Extyl.loadNext('offers-list-list', null, {
            PAGEN_2: ++self.current_page,
        });
    },
};
