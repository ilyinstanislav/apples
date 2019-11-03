<?php

namespace backend\widgets;

use common\widgets\LeftMenu as BaseWidget;
use yii\helpers\Html;

/**
 * Class LeftMenu
 * меню администратора
 * @package backend\widgets
 */
class LeftMenu extends BaseWidget
{
    /**
     * Рендер виджета
     */
    public function run()
    {
        $this->items = [
            [
                'icon' => 'kt-menu__link-icon flaticon2-gear',
                'label' => 'Яблоки',
                'url' => ['/apples/index'],
            ],
            [
                'icon' => 'kt-menu__link-icon flaticon-logout',
                'label' => 'Выход',
                'url' => ['/site/logout']
            ],
        ];

        return parent::run();
    }

    /**
     * @param $value
     * @return string|null
     */
    protected function renderBadge($value)
    {
        $badge = null;
        if ($value) {
            $badge = Html::tag('span', $value, ['class' => 'kt-badge kt-badge--rounded kt-badge--danger']);
            $badge = Html::tag('span', $badge, ['class' => 'kt-menu__link-badge']);
        }
        return $badge;
    }

}
