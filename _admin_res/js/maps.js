$(document).ready(function() {

    $("#e6").select2({
        placeholder: "Выберите позицию",
        minimumInputLength: 1,
        ajax: {
            url: getUrl(),
            dataType: 'jsonp',
            quietMillis: 250,
            data: function (term, page) {
                return getData(term);
            },
            results: function (data, page) {
                return { results: getCollection(data) };
            },
            cache: true
        },
        initSelection: function(element, callback) {
            var id = $(element).val();
            // заполняем наш селект значением поумолчанию на основе координат из input элемента
            if (id !== "") {
                $.ajax(getUrl(), {
                    dataType: "jsonp",
                    data: getData(id)
                }).done(function(data) {

                    var collection = getCollection(data);

                    if (collection.length) {
                        return callback(collection[0]);
                    }
                });
            }
        },
        formatResult: formatResult, //формируем вывод выпадающего списка дополнения
        formatSelection: formatSelection,  //формируем вывод выбранного элемента
        id: formatID, //указываем какой аттрибут будет являтся ID
        dropdownCssClass: "bigdrop", // применяем класс
        escapeMarkup: function (m) { return m; } //откючаем экранирование разметки, т.к мы используем html теги в форматировании
    });
});

//предоставляем массив гео объектов или пустой если нет данных
function getCollection(data) {
    var collection = [];
    if (data.response && data.response.GeoObjectCollection && data.response.GeoObjectCollection.featureMember) {
        collection = data.response.GeoObjectCollection.featureMember;
    }

    return collection;
}

// выносим ссылку на api геокодера, дабы не писать ее дважды
function getUrl() {
    return "http://geocode-maps.yandex.ru/1.x";
}

// тоже, чтоб не писать дважды
function getData(id) {
    return {
        geocode: id,
        format: 'json'
    };
}

function formatResult(object, $container, query) {
    return formatGeoObject(object);
}

function formatSelection(object, $container) {
    return formatGeoObject(object);
}

// объект GeoObject содержит очень много данных, можно поглядеть http://geocode-maps.yandex.ru/1.x/?format=json&geocode=%D0%A2%D0%B2%D0%B5%D1%80%D1%81%D0%BA%D0%B0%D1%8F+6
function formatGeoObject(object) {

    if (object.GeoObject) {
        $("#region_id").val(object.GeoObject.metaDataProperty.GeocoderMetaData.AddressDetails.Country.AdministrativeArea.AdministrativeAreaName);
        $("#area_id").val(object.GeoObject.metaDataProperty.GeocoderMetaData.AddressDetails.Country.AdministrativeArea.SubAdministrativeArea.SubAdministrativeAreaName);
        $("#city_id").val(object.GeoObject.name);
        return "{description} {name}"
            .replace('{name}', object.GeoObject.name)
            .replace('{description}', object.GeoObject.description);
    }
}

// позиция объекта будет являтся нашим ID
function formatID(object) {
    return object.GeoObject.Point.pos;
}
