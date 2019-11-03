<?php

use backend\assets\LoginAsset;
use yii\helpers\Html;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="ru">
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="/favicon.ico"/>
        <?php echo Html::csrfMetaTags() ?>
        <title><?php echo Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <!-- end::Head -->

    <!-- begin::Body -->
    <?php $this->beginBody() ?>
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor login-bg">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="/">
                                <img src="/images/logos/logo-5.png">
                            </a>
                        </div>
                        <?php echo $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Page -->
    </body>

    <!-- end::Body -->
    <?php $this->endBody() ?>
    </html>
<?php $this->endPage() ?>