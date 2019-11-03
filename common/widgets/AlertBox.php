<?php
namespace common\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class AlertBox extends Widget
{
    /**
     * типы алертов
     * @var array
     */
    protected $_types = ['success','warning', 'info'];

    /**
     * классы блоков алертов
     * @var array
     */
    protected $_classes = [
        'success' => 'alert alert-success border-0',
        'info' => 'alert alert-info border-0',
		'warning' => 'alert alert-danger border-0',
    ];

    /**
     * рендер виджета
     * @return string|void
     */
    public function run(){
        foreach($this->_types as $type){
            print $this->getAlert( $type );
        }
    }

    /**
     * рендер алерта
     * @param $type
     * @return string|void
     */
    protected function getAlert( $type ){
        if(!Yii::$app->session->hasFlash($type)){
            return;
        }

        return Html::tag('div', Yii::$app->session->getFlash($type), [
            'class' => ArrayHelper::getValue($this->_classes, $type)
        ]);
    }
}
