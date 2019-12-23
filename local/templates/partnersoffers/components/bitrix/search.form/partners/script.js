window.top.Extyl = window.top.Extyl || {};

window.top.Extyl.SearchForm = {

    SEARCH_AJAX_URL: null,
    CONTAINER: null,

    init: function() {

        Extyl.SearchForm.CONTAINER = $('[data-role="search-result-area"]');

        $('form.form__search')
            .off('submit', Extyl.SearchForm.search)
            .on('submit', Extyl.SearchForm.search)
        ;
    },

    search: function(e) {

        e.preventDefault();

        var form = $(e.target);

        var q = form.find('input[type="text"]').val();

        $.ajax({
            url: Extyl.SearchForm.SEARCH_AJAX_URL,
            data: {
                q: q,
            },
            dataType: 'json',
            success: function(msg) {
                Extyl.SearchForm.CONTAINER.html('');

                if ( ! msg.status) {
                    for (var er in msg.errors) {
                        Extyl.SearchForm.CONTAINER.append('<h5 style="color:gray;">'+msg.errors[er].title+'</h5>');
                    }
                } else {
                    for (var da in msg.data) {
                        console.log(msg.data[da]);
                        Extyl.SearchForm.CONTAINER.append(Extyl.fillTemplate('search-result-card', msg.data[da]));
                    }
                }
            },
        });
    }
};
