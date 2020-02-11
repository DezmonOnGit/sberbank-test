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

    var self = Extyl.PartnersFilter;
    $.ajax({
        url: '/api/v1/partnersFilter.php',
        dataType: 'json',
        data: filter,
        success: function(msg) {

            if ( ! Extyl.compareObjects(self.current, filter)) {
                Extyl.partnersPager.dropPage();
            }

            self.current = filter;

            Extyl.reloadArea('partners-list');
            Extyl.reloadArea('offers-list');
            Extyl.reloadArea('offersbundles-list');
            Extyl.reloadArea('selects-list');
        }
    });
};

window.top.Extyl.PartnersFilter = {

    current: {},
    categories: [],
    displayedCats: [],
    displayLines: 0,
    lineSize: 0,

    CONTAINER: null,

    init: function(categories) {
        this.categories = categories;
        this.CONTAINER = $('.filter__inner.container');
        this.calcLineSize();

        window.addEventListener('resize', this.calcLineSize);

        this.addLine();
        this.addLine();
    },

    initEvents: function() {
        $('.filter.filter--offsets [data-cat-id].button')
            .off('click', Extyl.PartnersFilter.setCategory)
            .on('click', Extyl.PartnersFilter.setCategory)
        ;
        $('#switcher-1')
            .off('click', Extyl.PartnersFilter.setChargeAccept)
            .on('click', Extyl.PartnersFilter.setChargeAccept)
        ;
    },

    countLines: function() {
        var self = Extyl.PartnersFilter;
        return Math.round(self.CONTAINER[0].offsetHeight / self.lineSize);
    },

    calcLineSize: function() {
        Extyl.PartnersFilter.lineSize = $('div.filter__item')[0].offsetHeight + 8;
    },

    addLine: function(ignore) {
        var self = Extyl.PartnersFilter;
        var willDisplay = +self.displayLines + +1;
        var lastAddedId = null;
        self.removeMoreButton();
        for (i in self.categories) {
            self.addMoreButton();
            // self.addMoreButton();
            if (self.countLines() > willDisplay) {
                    $('[data-cat-id="'+lastAddedId+'"]').remove();
                    self.displayedCats = self.displayedCats.filter(function(item) {return item !== lastAddedId});
                break;
            }
            self.removeMoreButton();
            self.CONTAINER.append($('script#button-template').html()
                .replace(/{{cat-id}}/g, self.categories[i].ID)
                .replace(/{{cat-name}}/g, self.categories[i].NAME)
                .replace(/{{cat-i}}/g, i)
                .replace(/{{button--active}}/g, '')
            );
            lastAddedId = self.categories[i].ID;
            self.displayedCats.push(lastAddedId);
        }
        self.removeMoreButton();

        for (i in self.categories) {
            if (~self.displayedCats.indexOf(self.categories[i].ID)) {
                delete self.categories[i];
                continue;
            }
            break;
        }

        if (self.categories.filter(function() {return true;}).length > 0) {
            self.addMoreButton();
        }

        self.displayLines = (self.countLines());

        self.initEvents();

        self.categories = self.categories.filter(function() {return true;});

        return self;
    },

    addMoreButton: function() {
        var self = Extyl.PartnersFilter;

        var btn = $('script#more-button-template').html().replace(/{{role}}/g, 'data-role="cats-more-btn"');
        self.CONTAINER.append(btn);

        $('[data-role="cats-more-btn"] .button')
            .off('click', self.addLine)
            .on('click', self.addLine)
        ;

        return self;
    },
    removeMoreButton: function() {
        var self = Extyl.PartnersFilter;

        $('.filter__item.more-button').remove();

        return self;
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
        Extyl.partnersPager.dropPage();
    },

    setChargeAccept: function (e) {
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
        Extyl.partnersPager.dropPage();
    },
};