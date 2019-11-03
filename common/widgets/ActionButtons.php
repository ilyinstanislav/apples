<?php
namespace common\widgets;

use yii\helpers\Html;
use yii\base\Widget;

class ActionButtons extends Widget
{
    /**
     * кнопки на странице
     * @var array
     */
    public $buttons = [];

    /**
     * Html опции контейнера
     * @var array
     */
    public $options = [
        'class' => 'kt-subheader__wrapper'
    ];

    /**
     * разделитель кнопок
     * @var string
     */
    public $separator = ' ';

    /**
     * шаблон тулбара
     * @var string
     */
    public $template = "<div class='kt-subheader__toolbar'>\n{buttons}\n</div>";

    /**
     * рендер кнопок
     * @return string
     */
    public function run(){
        $buttons = implode($this->separator, $this->buttons);
        $buttons = Html::tag( 'div', $buttons, $this->options);

        return str_replace('{buttons}', $buttons, $this->template);
    }
}
