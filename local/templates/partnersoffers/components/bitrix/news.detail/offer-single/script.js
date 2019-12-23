var shops = [];

$(function () {
    ymaps.ready(function () {

        //карта на детальной странице партнера
        if(document.querySelector("#map-partner")) {
            //центрируется по адресу первого магазина
            var partnerMap = new ymaps.Map("map-partner", {
                center: shops[0].coords,
                zoom: 15,
                controls: []
            });

            //добавляем маркер для первого магазина
            if (partnerMap) {
                partnerMap.geoObjects.add(new ymaps.Placemark(shops[0].coords));
            }
        }

        //карта на детальной странице партнера в модальном окне с адресами
        if(document.querySelector("#map-addresses")) {

            var addressesMap = new ymaps.Map("map-addresses", {
                center: shops[0].coords,
                zoom: 15,
            });

            if (addressesMap) {
                //объекты карты для geoQuery
                var objects = [];

                //список адресов
                var addressList = {};
                addressList.box = $('#map-addresses');
                addressList.wrapper = addressList.box.closest('.map--box');
                addressList.listBox =  addressList.wrapper.find('.map__list');

                addressList.addAddress = function(address) {
                    var newItem = '<li class="map__address">' + address + '</li>';

                    addressList.listBox.append(newItem);
                };

                addressList.clearAddressList = function() {
                    addressList.listBox.html('');
                };

                addressList.renderList = function(mapObjects) {
                    //для каждого маркера получаем адрес и добавляем в список
                    if(mapObjects.getLength()) {
                        mapObjects.each(function (item) {
                            ymaps.geocode(item.geometry._coordinates).then(function (result) {
                                var geoObjectAddress = result.geoObjects.get(0).getAddressLine();

                                addressList.addAddress(geoObjectAddress);
                            });
                        });
                    } else {
                        addressList.clearAddressList();
                    }
                };

                //добавляем все маркеры на карту
                shops.forEach(function (item) {
                    addressesMap.geoObjects.add(new ymaps.Placemark(item.coords, {
                        balloonContent: item.address,
                    }, {
                        preset: 'islands#icon',
                        iconColor: '#0095b6'
                    }));

                    //собираем массив для geoQuery
                    objects.push(
                        {
                            type: 'Point',
                            coordinates: item.coords,
                        }
                    );
                });

                var objectsQuery = ymaps.geoQuery(objects);

                //формируем список адресов в видимой области при зарузке страницы
                addressList.renderList(objectsQuery.searchInside(addressesMap));


                // После каждого сдвига карты будем смотреть, какие объекты попадают в видимую область.
                // и изменять список адресов
                addressesMap.events.add('boundschange', function () {
                    //маркеры попавшие в область видимости
                    var visibleObjects = objectsQuery.searchInside(addressesMap);

                    //чистим список адресов
                    addressList.clearAddressList();

                    //для каждого маркера получаем адрес и добавляем в список
                    addressList.renderList(visibleObjects);
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

        //карта на странице отдельного предложения
        if(document.querySelector("#map-action")) {

            var addressesMap = new ymaps.Map("map-action", {
                center: shops[0].coords,
                zoom: 15,
                controls: []
            });

            var geolocation = ymaps.geolocation;

            // Сравним положение, вычисленное по ip пользователя и
            // положение, вычисленное средствами браузера.
            geolocation.get({
                provider: 'yandex',
                mapStateAutoApply: true
            }).then(function (result) {
                // Красным цветом пометим положение, вычисленное через ip.
                result.geoObjects.options.set('preset', 'islands#redCircleIcon');
                result.geoObjects.get(0).properties.set({
                    balloonContentBody: 'Мое местоположение'
                });
                addressesMap.geoObjects.add(result.geoObjects);
            });

            if (addressesMap) {
                //объекты карты для geoQuery
                var objects = [];

                //список адресов
                var addressList = {};
                addressList.box = $('#map-action');
                addressList.wrapper = addressList.box.closest('.map--box');
                addressList.listBox =  addressList.wrapper.find('.map__list');

                addressList.addAddress = function(address) {

                    var newItemMetro, newItemLink, newItemPhone, newItemTime;

                    for (var i = 1; i < shops.length; i++) {
                        if (address == shops[i].address) {
                            var thisShop = shops[i];
                            newItemMetro = thisShop.metro.join(', ');
                            newItemLink = thisShop.website;
                            newItemPhone = thisShop.phone.join(', ');
                            newItemTime = thisShop.time;
                        }
                    }

                    var newItem = '<div class="address__info"><a href="#" class="address__link address__link--mobile">' + (newItemLink || '')
                        + '</a><a href="#" class="address__phone address__phone--mobile">' + (newItemPhone || '')
                        + '</a><span class="address__data">' + address +
                        '</span><span class="address__metro">' + (newItemMetro || '') +
                        '</span><div class="address__time">' + (newItemTime || '') +
                        '</div><a href="tel:+7495 220-30-44" class="address__phone address__phone--desktop">' + (newItemPhone || '') +
                        '</a><a href="#" class="address__link address__link--desktop">' + (newItemLink || '') + '</a></div>';


                    addressList.listBox.append(newItem);
                };

                addressList.clearAddressList = function() {
                    addressList.listBox.html('');
                };

                addressList.renderList = function(mapObjects) {
                    //для каждого маркера получаем адрес и добавляем в список
                    if(mapObjects.getLength()) {
                        mapObjects.each(function (item) {
                            ymaps.geocode(item.geometry._coordinates).then(function (result) {
                                var geoObjectAddress = result.geoObjects.get(0).getAddressLine();

                                addressList.addAddress(geoObjectAddress);
                            });
                        });
                    } else {
                        addressList.clearAddressList();
                    }
                };

                //добавляем все маркеры на карту
                shops.forEach(function (item) {
                    addressesMap.geoObjects.add(new ymaps.Placemark(item.coords, {
                        balloonContent: item.address,
                    }, {
                        preset: 'islands#icon',
                        iconColor: '#0095b6'
                    }));

                    //собираем массив для geoQuery
                    objects.push(
                        {
                            type: 'Point',
                            coordinates: item.coords,
                        }
                    );
                });

                var objectsQuery = ymaps.geoQuery(objects);

                //формируем список адресов в видимой области при зарузке страницы
                addressList.renderList(objectsQuery.searchInside(addressesMap));


                // После каждого сдвига карты будем смотреть, какие объекты попадают в видимую область.
                // и изменять список адресов
                addressesMap.events.add('boundschange', function () {
                    //маркеры попавшие в область видимости
                    var visibleObjects = objectsQuery.searchInside(addressesMap);

                    //чистим список адресов
                    addressList.clearAddressList();

                    //для каждого маркера получаем адрес и добавляем в список
                    addressList.renderList(visibleObjects);
                });

            }
        }
    });
});

