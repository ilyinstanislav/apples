<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class Box
 * виджет генерации контентного блока
 * @package common\widgets
 */
class Box extends Widget
{
    /**
     * текста заголовка блока
     * @var string
     */
    public $title;

    /**
     * текст подзаголовка блока
     * @var string
     */
    public $caption;

    /**
     * опции основного блока
     * @var array
     */
    public $options = [
        'class' => 'kt-portlet kt-portlet--mobile'
    ];

    /**
     * опции тега подзаголовка
     * @var array
     */
    public $captionOptions = [
        'class' => 'kt-portlet__caption'
    ];

    /**
     * опции для тела блока
     * @var array
     */
    public $bodyOptions = [
        'class' => 'kt-portlet__body'
    ];

    /**
     * опции блока заголовка
     * @var array
     */
    public $titleOptions = [
        'class' => 'kt-portlet__head'
    ];

    /**
     * опции тега заголовка
     * @var array
     */
    public $headerOptions = [
        'class' => 'kt-portlet__head-label'
    ];

    /**
     * опции блока действий
     * @var array
     */
    public $actionOptions = [
        'class' => 'kt-portlet__head-toolbar'
    ];

    /**
     * действия в блоке
     * @var array
     */
    public $actions = [];

    /**
     * @param array $params
     * @return Widget
     */
    public static function begin($params = [])
    {
        return parent::begin($params)
            ->beginBody();
    }

    /**
     * @return Widget
     */
    public static function end()
    {
        return parent::end()
            ->endBody();
    }

    /**
     * открытие блока
     * return @void
     */
    public function beginBody()
    {
        if ($this->id) {
            $this->options['id'] = $this->id;
        }

        print Html::beginTag('div', $this->options);

        $this->printHeader();

        print Html::beginTag('div', ['class' => $this->bodyOptions]);
    }

    /**
     * закрытие блока
     * return @void
     */
    public function endBody()
    {
        print Html::endTag('div');
        print Html::endTag('div');
    }

    /**
     * рендер заголовка блока
     * return @void
     */
    protected function printHeader()
    {
        if (empty($this->title) && empty($this->actions)) {
            return;
        }

        print Html::beginTag('div', $this->titleOptions);

        if ($this->title) {
            print Html::tag('div', Html::tag('h3', $this->title, ['class' => 'kt-portlet__head-title']), $this->headerOptions);
        }

        if ($this->caption) {
            print Html::tag('div', $this->caption, $this->captionOptions);
        }
        $this->printActions();

        print Html::endTag('div');
    }

    /**
     * вывод действий
     */
    protected function printActions()
    {
        if (empty($this->actions)) {
            return;
        }
        $buttons = Html::tag('div', implode(' ', $this->actions), ['class' => 'kt-portlet__head-group']);
        print Html::tag('div', $buttons, $this->actionOptions);
    }
}
