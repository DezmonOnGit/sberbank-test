if ( !!! window.top.Extyl) {
    window.top.Extyl = {};
}

/**
 *
 * @param filter = {
 *     category: 1,
 *     bonusType: 'charge|accept',
 * }
 */
window.top.Extyl.setPartnersFilter = function(filter) {

    $.ajax({
        url: '/api/v1/partnersFilter.php',
        dataType: 'json',
        data: filter,
        success: function(msg) {

            Extyl.PartnersFilter.current = filter;

            Extyl.reloadArea('partners-list');
            Extyl.reloadArea('offers-list');
            Extyl.reloadArea('offersbundles-list');
        }
    });
};

window.top.Extyl.PartnersFilter = {

    current: {},

    init: function() {
        $('.filter.filter--offsets button')
            .off('click', Extyl.PartnersFilter.setCategory)
            .on('click', Extyl.PartnersFilter.setCategory)
        ;
        $('#switcher-1')
            .off('click', Extyl.PartnersFilter.setChargeAccept)
            .on('click', Extyl.PartnersFilter.setChargeAccept)
        ;
    },

    setCategory: function (e) {
        var self = Extyl.PartnersFilter;
        if (typeof e === 'object') {
            self.setCategory($(this).attr('data-cat-id'));
        } else {
            $('.filter.filter--offsets button').removeClass('button--active');
            $('.filter.filter--offsets button[data-cat-id="'+e+'"]').addClass('button--active');
            Extyl.setPartnersFilter({
                category: e,
                chargeAccept: self.current.chargeAccept || 'charge',
            });
        }
    },
    setChargeAccept: function (e) {
        console.log(1);
        var self = Extyl.PartnersFilter;
        if (typeof e === 'object') {
            var val = $(this).is(':checked') ? 'accept' : 'charge';
            self.setChargeAccept(val);
        } else {
            Extyl.setPartnersFilter({
                category: self.current.category,
                chargeAccept: e,
            });
        }
    },
};