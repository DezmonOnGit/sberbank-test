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

window.top.Extyl.compareObjects = function(obj_1, obj_2, strict) {
    strict = strict || false;
    if (
        typeof obj_1 !== 'object'
        || typeof obj_2 !== 'object'
    ) {
        return (
            strict && obj_1 === obj_2
            || ! strict && obj_1 == obj_2
        );
    }

    var keys = [].concat(Object.keys(obj_1), Object.keys(obj_2));

    for (var i in keys) {
        if (obj_1.hasOwnProperty(keys[i])) {
            if ( ! obj_2.hasOwnProperty(keys[i])) {
                return false;
            }
            if ( ! Extyl.compareObjects(obj_1[keys[i]], obj_2[keys[i]])) {
                return false;
            }
        } else {
            return false;
        }
    }

    return true;
};
