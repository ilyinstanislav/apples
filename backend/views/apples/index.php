<?php

use yii\helpers\Html;

$this->title = 'Эксперименты с яблоками';

$this->buttons = [
    Html::a('Сгенерировать новые яблоки', ['/apples/generate-new'], [
        'class' => 'btn btn-sm btn-primary',
    ])
];

?>
<div class="row">
    <?php
    foreach ($apples as $apple) {
        echo $this->render('_apple', compact('apple', 'model'));
    }
    ?>
</div>