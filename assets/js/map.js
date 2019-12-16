$(function () {
    ymaps.ready(function () {
        if(document.querySelector("#map-partner")) {
            var partnerMap = new ymaps.Map("map-partner", {
                center: [55.76, 37.64],
                zoom: 15,
                controls: []
            });

            if (partnerMap) {
                ymaps.modules.require(['Placemark', 'Circle'], function (Placemark, Circle) {
                    var placemark = new Placemark([55.37, 35.45]);
                });
            }
        }

        if(document.querySelector("#map-addresses")) {
            var addressesMap = new ymaps.Map("map-addresses", {
                center: [55.76, 37.64],
                zoom: 15,
            });

            if (addressesMap) {
                ymaps.modules.require(['Placemark', 'Circle'], function (Placemark, Circle) {
                    var placemark = new Placemark([55.37, 35.45]);
                });
            }
        }

        if(document.querySelector("#map-offer")) {
            var offerMap = new ymaps.Map("map-offer", {
                center: [55.76, 37.64],
                zoom: 15,
                controls: []
            });

            if (offerMap) {
                ymaps.modules.require(['Placemark', 'Circle'], function (Placemark, Circle) {
                    var placemark = new Placemark([55.37, 35.45]);
                });
            }
        }
    });
});