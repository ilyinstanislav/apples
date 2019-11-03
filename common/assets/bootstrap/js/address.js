/**
 * инициализация виджета
 * @param $city_field
 * @param $address_field
 * @param $params
 */
const addressWidgetInit = function ($city_field, $address_field, $params) {
    $($city_field).change(function () {
        const region_name = $(this).find('option:selected').text();

        $params.formatResult = function (value, currentValue, suggestions) {
            return formatAddress(suggestions);
        };

        $params.formatSelected = function (value) {
            return formatAddress(value);
        };

        $params.params = {
            locations: [{
                region: region_name
            }]
        };

        $($address_field).suggestions($params);

    }).change();
}

/**
 * форматирование адресной строки
 * @param suggestion
 * @returns {string}
 */
const formatAddress = function (suggestion) {
    const {data: {street_with_type, house_type, house, flat_type, flat, block_type, block}} = suggestion;
    let address = [street_with_type];

    if (house) {
        let house_line = house_type + ' ' + house;
        if (block) {
            house_line += ' ' + block_type + ' ' + block;
        }
        address.push(house_line);
    }

    if (flat) {
        address.push(flat_type + ' ' + flat);
    }

    return address.filter(value => value).join(', ');
};