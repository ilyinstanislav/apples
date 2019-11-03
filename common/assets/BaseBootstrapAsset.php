<?php

namespace common\assets;

use yii\web\JqueryAsset;
use yii\web\YiiAsset;
use yii\web\AssetBundle;

/**
 * Class BaseBootstrapAsset
 * @package common\assets
 */
class BaseBootstrapAsset extends AssetBundle
{
    /**
     * публикуемый каталог набора
     * @var string
     */
    public $sourcePath = '@common/assets/bootstrap';

    /**
     * список подключаемых стилей
     * @var array
     */
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&display=swap&subset=cyrillic-ext',
        'vendors/perfect-scrollbar/css/perfect-scrollbar.css',
        'vendors/tether/dist/css/tether.css',
        'vendors/animate.css/animate.css',
        'vendors/flaticon/flaticon.css',
        'vendors/flaticon2/flaticon.css',
        'vendors/@fortawesome/fontawesome-free/css/all.min.css',
        'vendors/line-awesome/css/line-awesome.css',
        'css/m.css'
    ];

    /**
     * список подключаемых скриптов
     * @var array
     */
    public $js = [
        'vendors/popper.js/dist/umd/popper.js',
        'vendors/bootstrap/dist/js/bootstrap.min.js',
        'vendors/perfect-scrollbar/dist/perfect-scrollbar.js',
        'vendors/sticky-js/dist/sticky.min.js',
        'vendors/block-ui/jquery.blockUI.js',
        'vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
        'vendors/typeahead.js/dist/typeahead.bundle.js',
        'vendors/handlebars/dist/handlebars.js',
        'vendors/autosize/dist/autosize.js',
        'vendors/toastr/build/toastr.min.js',
        'vendors/es6-promise-polyfill/promise.min.js',
        'vendors/es6-promise-polyfill/promise.min.js',
        'js/x.js',
    ];

    /**
     * зависимости набора
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
        YiiAsset::class,
    ];
}
