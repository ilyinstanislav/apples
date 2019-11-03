<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<div class="kt-login__signin">
    <div class="kt-login__head">
        <h3 class="kt-login__title">Вход на сайт</h3>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?php
    echo $form->field($model, 'username')
        ->textInput([
            'placeholder' => 'Email',
            'autofocus' => true
        ]);

    echo $form->field($model, 'password')
        ->passwordInput([
            'placeholder' => 'Пароль'
        ]);
    ?>

    <div class="row kt-login__extra">
        <div class="col">
            <label class="kt-checkbox">
                <?php echo Html::activeCheckbox($model, 'rememberMe', ['label' => false]) ?>
                Запомнить меня
                <span></span>
            </label>
        </div>
    </div>
    <div class="kt-login__actions">
        <button id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Авторизоваться
        </button>
    </div>
    <?php ActiveForm::end(); ?>
</div>