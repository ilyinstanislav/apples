<?php

namespace common\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs as BaseWidget;

class Breadcrumbs extends BaseWidget
{
    /**
     * основной тег
     * @var string
     */
    public $tag = 'div';

    /**
     * шаблон элемента списка
     * @var string
     */
    public $itemTemplate = "{link}\n";

    /**
     * опции ссылки
     * @var array
     */
    public $linkOptions = [
        'class' => 'kt-subheader__breadcrumbs-link'
    ];

    /**
     * шаблон активного элемента списка
     * @var string
     */
    public $activeItemTemplate = "{link}\n";

    /**
     * разделитель элементов списка
     * @var string
     */
    public $divider = "<span class='kt-subheader__breadcrumbs-separator'></span>\n";

    /**
     * HTML опции основного блока
     * @var array
     */
    public $options = [
        'class' => 'kt-subheader__breadcrumbs'
    ];

    /**
     * return null
     */
    public function init()
    {
        $this->homeLink = [
            'label' => 'Главная страница',
            'url' => '/',
            'class' => 'kt-subheader__breadcrumbs-link'
        ];
        return parent::init();
    }

    /**
     * Рендер списка
     * @return string|void
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        if (empty($this->links)) {
            return;
        }
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                'label' => Yii::t('yii', 'Home'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        }
        elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }

        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }
            else {
                $link = ArrayHelper::merge($this->linkOptions, $link);
            }

            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode($this->divider, $links), $this->options);
    }
}
