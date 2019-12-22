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

            Extyl.reloadArea('partner-list');
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
    },

    setCategory: function (e) {
        var self = Extyl.PartnersFilter;
        console.log({
            category: e,
            chargeAccept: self.current.chargeAccept || 'charge',
        });
        if (typeof e === 'object') {
            self.setCategory($(this).attr('data-cat-id'));
        } else {
            Extyl.setPartnersFilter({
                category: e,
                chargeAccept: self.current.chargeAccept || 'charge',
            });
        }
    },
    setChargeAccept: function () {},
};