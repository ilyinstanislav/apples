<?php

use common\widgets\Box;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

?>
<div class="col-12 col-sm-6 col-md-4 apple_container_<?= $apple->id ?>">
    <?php
    Pjax::begin([
        'id' => 'apple_' . $apple->id
    ]);
    Box::begin([
        'title' => 'Яблоко ' . $apple->id,
        'actions' => [
            !$apple->isFalled
                ? Html::a('Упасть', ['/apples/fall', 'id' => $apple->id],
                [
                    'class' => 'btn btn-sm btn-default apple_faller',
                    'data-apple_id' => $apple->id,
                    'data-pjax' => 0
                ])
                : '',
            Html::a('Удалить', ['/apples/remove', 'id' => $apple->id],
                [
                    'class' => 'btn btn-sm btn-danger apple_remover',
                    'data-apple_id' => $apple->id,
                    'data-pjax' => 0
                ]),
        ]
    ]);

    echo $this->render('_images', compact('apple'));

    echo "Появилось: " . date('d.m.Y H:i:s', strtotime($apple->dt_create)) . "<br/>";
    echo "Состояние: {$apple->conditionName}<br/>";
    echo "Остаток: {$apple->size}%<br/>";

    if ($apple->isFalled && !$apple->isDecayed) {
        echo 'Испортится через: ' . ($apple->expirationTime - $apple->lyingDuration) . ' часов<br/>';
    }

    echo $this->render('_form', compact('apple', 'model'));

    Box::end();
    $this->registerJs("eatForm.init()", View::POS_READY);
    Pjax::end();
    ?>
</div>