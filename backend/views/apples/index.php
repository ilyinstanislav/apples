<?php

use backend\grid\GridView;
use backend\widgets\Box;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->buttons = [
    Html::a('Сгенерировать новые яблоки', ['/apples/generate-new'], [
        'class' => 'btn btn-sm btn-primary',
    ])
];

echo '<div class="row">';
foreach ($apples as $apple) {
    echo '<div class="col-sm-4">';
    Pjax::begin();
    Box::begin([
        'title' => 'Яблоко ' . $apple->id,
        'actions' => [
            Html::a('Упасть', ['/apples/generate-new'], [
                'class' => 'btn btn-sm btn-default',
            ]),

        ]
    ]);

    echo 'Картинка яблока<br/>';
    echo 'Состояние: '.$apple->conditionName.'<br/>';
    echo 'Лежит: '.$apple->lyingDuration.' часов<br/>';
    echo 'Цвет: '.$apple->colorCode.'<br/>';

    Box::end();
    Pjax::end();
    echo '</div>';


//echo GridView::widget([
//    'dataProvider' => $model->search(),
//    'filterModel' => $model,
//    'columns' => [
//        [
//            'attribute' => 'name',
//            'format' => 'raw',
//            'value' => function($data){
//                return Html::a( $data->name, ['update', 'id' => $data->id], ['data-pjax'=>0]);
//            }
//        ],
//    ]
//]);
}
echo '</div>';
