/**
 * создание виджета
 * @param $id
 * @param $options
 */
function multiSelect($id, $options) {
    if (typeof $options != 'object') {
        $options = {};
    }

    this._id = $id;
    this._search_placeholder = 'Искомое значение';

    $options.search = true;
    if ($options.search) {
        $options = this.generateSearchOptions();
    }

    $options.selectableFooter = '<div class="custom-footer btn btn-clean btn-bold btn-upper" id="' + this._id + '_select_all">Выбрать все</div>';
    $options.selectionFooter = '<div class="custom-footer btn btn-default btn-bold btn-upper" id="' + this._id + '_deselect_all">Очистить</div>';

    this.select = $('#' + this._id).multiSelect($options);
    this.registerButtons();
};

/**
 * привязка действий для выбора всех опций и очистки
 * @return void
 */
multiSelect.prototype.registerButtons = function () {
    var $id = this._id;
    $('#' + $id + '_select_all').click(function () {
        $('#' + $id).multiSelect('select_all');
    });

    $('#' + $id + '_deselect_all').click(function () {
        $('#' + $id).multiSelect('deselect_all');
    });
}

/**
 * генерация опция для списка с поиском по значению
 * @returns {{selectableHeader: string, afterSelect: afterSelect, afterInit: afterInit, selectionHeader: string, afterDeselect: afterDeselect}}
 */
multiSelect.prototype.generateSearchOptions = function () {
    var self = this;
    return {
        selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='" + this._search_placeholder + "'>",
        selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='" + this._search_placeholder + "'>",
        afterInit: function (ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function (e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function (e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });

            self.registerButtons();
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    };
};