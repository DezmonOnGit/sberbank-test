window.top.Extyl = window.top.Extyl || {};

window.top.Extyl.SearchForm = {

    SEARCH_AJAX_URL: null,
    CONTAINER: null,
    FORM: null,

    init: function() {

        Extyl.SearchForm.CONTAINER = $('[data-role="search-result-area"]');

        this.FORM = $('form.form__search');

        this.FORM
            .off('submit', Extyl.SearchForm.search)
            .on('submit', Extyl.SearchForm.search)
        ;

        this.FORM.find('input.input__search')
            .off('keyup', Extyl.SearchForm.search)
            .on('keyup', Extyl.SearchForm.search)
        ;
    },

    search: function(e) {

        if (e.type === 'submit') {
            e.preventDefault();
        }
        console.log(e);
        if (e.key === 'Escape') {
            Extyl.Search.hideInner();
            return;
        }

        var form = $(Extyl.SearchForm.FORM);

        var q = form.find('input.input__search').val();
        if ( ! q.length) {
            Extyl.SearchForm.CONTAINER.html('<h5 style="color:gray;">По вашему запросу ничего не найдено</h5><br>');
            return;
        }

        $.ajax({
            url: Extyl.SearchForm.SEARCH_AJAX_URL,
            data: {
                q: q,
            },
            dataType: 'json',
            success: function(msg) {
                Extyl.SearchForm.CONTAINER.html('');

                if (!msg.status) {
                    for (var er in msg.errors) {
                        Extyl.SearchForm.CONTAINER.append('<h5 style="color:gray;">' + msg.errors[er].title + '</h5><br>');
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
