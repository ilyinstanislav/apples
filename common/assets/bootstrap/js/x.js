$(function () {
    $(document).on('pjax:beforeSend', function () {
        var popovers = $('[data\-toggle="popover"]');
        if (popovers.length) {
            popovers.popover('hide');
        }

        var select2 = $('.kt-select2');
        if (select2.length) {
            select2.select2('close');
        }
    });

    $(document).on('pjax:end', function () {
        KTApp.init();
    });

    var th_link_IsBusy = false;

    $(document).on('mouseup', 'th.sorting,th.sorting_asc,th.sorting_desc', function () {
        var link = $(this).find('a');
        link.click();
    });

    $(document).on('click', 'th.sorting a,th.sorting_asc a,th.sorting_desc a', function () {
        if (th_link_IsBusy) {
            return false;
        }
        th_link_IsBusy = true;
        setTimeout(function () {
            th_link_IsBusy = false;
        }, 100);
    });

    //чистим окно после закрытия, чтобы при открытии новго в нем не отображались старые данные
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).find('.modal-body').html('');
        $(this).find('.modal-header h5').remove();
    });
});
(function ($) {
    $.fn.waiter = function (condition, callback) {
        var interval = setInterval(function () {
            if (condition()) {
                callback();
                clearInterval(interval);
            }
        }, 100);
    };
}(jQuery));
