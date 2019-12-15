
function MS_bindDownload(el) {
    if(el === undefined){
        throw Error('I need element parameter.');
    }
    if(el.href === ''){
        throw Error('The element has no href value.');
    }
    var filename = el.getAttribute('download');
    if (filename === null || filename === ''){
        var tmp = el.href.split('/');
        filename = tmp[tmp.length-1];
    }
    el.addEventListener('click', function (evt) {
        evt.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.onloadstart = function () {
            xhr.responseType = 'blob';
        };
        xhr.onload = function () {
            navigator.msSaveOrOpenBlob(xhr.response, filename);
        };
        xhr.open("GET", el.href, true);
        xhr.send();
    })
}

function msieversion() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;
    var flag = false;

    if (msie > 0) {
        flag = true;
    }

    return flag;
}

function linkDownload(el, evt) {
    if(msieversion()) {
        evt.preventDefault();
        MS_bindDownload(el);
    }
}