<?php

namespace backend\assets;

use common\assets\BaseBootstrapAsset;
use common\assets\CommonAsset;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends CommonAsset
{
    public $css = [
        'css/style.bundle.css',
        'css/m.css',
        'front/css/login-4.min.css',
        'front/css/m.css',
    ];
}
