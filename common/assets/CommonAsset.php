<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Common application asset bundle.
 */
class CommonAsset extends AssetBundle
{
    public $sourcePath = '@common/assets';

    public $css = [
        'css/style.bundle.css',
        'css/m.css',
    ];
    public $js = [
        'js/scripts.bundle.js'
    ];
    public $depends = [
        BaseBootstrapAsset::class
    ];
}
