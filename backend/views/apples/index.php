<?php

use backend\grid\GridView;
use backend\widgets\Box;
use yii\helpers\Html;
use yii\widgets\Pjax;

Box::begin([
    'title' => 'Яблоки'
]);

Pjax::begin();
echo 'apples';
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

Pjax::end();
Box::end();