var eatForm = {
    init: function () {
        $('.eat_form').on('beforeSubmit', function (event, jqXHR, settings) {
            var apple_id = $(this).data('apple_id');

            $.ajax({
                type: 'GET',
                url: '/apples/isset',
                data: {
                    id: apple_id,
                }
            })
                .done(function (data) {
                    if (!data.isset) {
                        $('.apple_container_' + apple_id).remove();
                    }
                    $.pjax.reload({
                        container: '#apple_' + apple_id,
                        timeout: 10000,
                    });
                })
                .fail(function () {
                    alert('Что-то пошло не так, попробуйте позже.');
                });
            return false;
        });

        $('.apple_faller').click(function () {
            var apple_id = $(this).data('apple_id');
            $.ajax({
                type: 'GET',
                url: '/apples/fall',
                data: {
                    id: apple_id,
                }
            })
                .done(function () {
                    $.pjax.reload({
                        container: '#apple_' + apple_id,
                        timeout: 10000,
                    });
                })
                .fail(function () {
                    alert('Что-то пошло не так, попробуйте позже.');
                });

            return false;
        });

        $('.apple_remover').click(function () {
            var apple_id = $(this).data('apple_id');
            $.ajax({
                type: 'GET',
                url: '/apples/remove',
                data: {
                    id: apple_id,
                }
            })
                .done(function (data) {
                    if (data.success) {
                        $('.apple_container_' + apple_id).remove();
                    }
                })
                .fail(function () {
                    alert('Что-то пошло не так, попробуйте позже.');
                });

            return false;
        });
    }
};
