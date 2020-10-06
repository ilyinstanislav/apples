<?php

use common\models\Apple;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var Apple $apple */
if ($apple->isFalled) {
    $form = ActiveForm::begin([
        'action' => ['apples/eat', 'id' => $apple->id],
        'options' => ['class' => 'eat_form', 'data-apple_id' => $apple->id],
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
        'validateOnType' => false,
        'validateOnSubmit' => true,
    ]);
    print $form->field($model, 'size')->textInput();
    print Html::submitButton('Укусить', ['class' => 'btn btn-sm btn-primary']);
    $form->end();
}