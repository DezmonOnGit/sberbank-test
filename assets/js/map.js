$(function () {
    ymaps.ready(function () {
        var map = new ymaps.Map("map-partner", {
            center: [55.76, 37.64],
            zoom: 15,
            controls: []
        });

        if (map) {
            ymaps.modules.require(['Placemark', 'Circle'], function (Placemark, Circle) {
                var placemark = new Placemark([55.37, 35.45]);
            });
        }
    });
});