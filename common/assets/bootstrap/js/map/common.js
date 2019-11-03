/**
 * класс для работы с картой яндекс
 * @param id ID блока в который грузится карта
 * @param options опции для карты
 * @param load_callback колбек при загрузке карты
 * @param geocode_callback колбек для геокодинга
 */
function map(id, options, load_callback, geocode_callback) {
    this.map = null;
    this.options = options;
    this.load_callback = load_callback;
    this.geocode_callback = geocode_callback;

    var self = this;
    $(window).waiter(function () {
        return window.ymaps;
    }, function () {
        ymaps.ready(function () {
            self.map = new ymaps.Map(id, options);
            self.load_callback(self);
        });
    });
}

/**
 * геокодирование адреса
 * @param string needle
 */
map.prototype.geocode = function (needle) {
    var self = this;
    ymaps.geocode(needle, {
        results: 1
    }).then(function (res) {
        self.addBaloon(res.geoObjects.get(0));
    });
}

/**
 * добавление результата геокодирования на карту
 * @param geoObject
 */
map.prototype.addBaloon = function (geoObject) {
    // Очистка карты, перед добавлением нового объекта
    this.map.geoObjects.removeAll();

    var myPlacemark = new ymaps.Placemark(geoObject.geometry.getCoordinates(), {
        hintContent: '',
        balloonContent: ''
    }, {
        iconLayout: 'default#image',
        iconImageHref: '/images/map-icon.png',
        iconImageSize: [39, 39],
        iconImageOffset: [-19.5, -39]
    });
    this.map.geoObjects.add(myPlacemark);

    // Область видимости геообъекта.
    var bounds = geoObject.properties.get('boundedBy');

    // Добавляем первый найденный геообъект на карту.
    // this.map.geoObjects.add(geoObject);
    // Масштабируем карту на область видимости геообъекта.
    this.map.setBounds(bounds, {
        // Проверяем наличие тайлов на данном масштабе.
        checkZoomRange: true
    });

    if (this.options.zoom) {
        this.map.setZoom(this.options.zoom);
    }
    this.map.setCenter(geoObject.geometry.getCoordinates());

    this.geocode_callback(geoObject.geometry);
}

/**
 * добавление меток на карту и привязка клика по ним с выбором в селекте
 * @param geoObject
 */
map.prototype.addBaloonWithAction = function (group, input) {
    // Очистка карты, перед добавлением нового объекта
    this.map.geoObjects.removeAll();

    // Коллекция для геообъектов группы.
    var collection = new ymaps.GeoObjectCollection(null, {
        iconLayout: 'default#image',
        iconImageHref: '/images/map-icon.png',
        iconImageSize: [39, 39],
        iconImageOffset: [-19.5, -39]
    });

    // Добавляем коллекцию на карту.
    this.map.geoObjects.add(collection);
    for (var j = 0, m = group.length; j < m; j++) {
        var item = group[j];
        placemark = new ymaps.Placemark(item.center, {
            hintContent: '',
            balloonContent: '',
            point_id: item.id
        });
        placemark.events.add('click', function (e) {
            var point_id = e.get('target').properties._data.point_id;
            $('#' + input).val(point_id);
            $('#' + input).trigger('change');
            $('#map-modal').modal('hide');
        });

        // Добавляем метку в коллекцию.
        collection.add(placemark);
        // Применяем область показа к карте
        this.map.setBounds(this.map.geoObjects.getBounds(), {checkZoomRange:true}).then(function(){ if(map.getZoom() > 8) map.setZoom(8);});
    }
}
