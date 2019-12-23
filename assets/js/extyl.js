if ( !!! window.top.Extyl) window.top.Extyl = {};

window.top.Extyl.reloadArea = function(type, id, options) {
    id = id || null;
    options = options || {};
    var selector = '[data-area-type="'+type+'"]';
    if (id) {
        selector += '[data-area-id="'+id+'"]';
    }
    $(selector).each(function() {

        var self = $(this);
        var data = JSON.parse(JSON.stringify(options));
        data.areaType = self.attr('data-area-type');
        $.ajax({
            url: location.href,
            dataType: 'html',
            data: data,
            method: 'get',
            type: 'get',
            success: function(msg) {
                self.html(msg);
            },
        });
    });
};

window.top.Extyl.loadNext = function(type, id, options) {
    id = id || null;
    options = options || {};
    var selector = '[data-area-type="'+type+'"]';
    if (id) {
        selector += '[data-area-id="'+id+'"]';
    }
    $(selector).each(function() {

        var self = $(this);
        var data = JSON.parse(JSON.stringify(options));
        data.areaType = self.attr('data-area-type');
        $.ajax({
            url: location.href,
            dataType: 'html',
            data: data,
            method: 'get',
            type: 'get',
            success: function(msg) {
                self.append(msg);
            },
        });
    });
};

window.top.Extyl.fillTemplate = function(templateId, options) {
    let template = $('#'+templateId+'-template').html();

    return template.replace(/{{\s*(.*?)\s*}}/g, function(g0, g1) {

        return options[g1] || '';
    });
};