<?php

namespace common\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Menu as BaseWidget;

/**
 * Class LeftMenu
 * Кастомизированный виджет yii\widgets\Menu
 *
 * @package common\widgets
 */
class LeftMenu extends BaseWidget
{
    /**
     * HTML опции основного тега
     * @var array
     */
    public $options = [
        'class' => "kt-menu__nav"
    ];

    /**
     * опции каждого элемента <li>
     * @var array
     */
    public $itemOptions = [
        'class' => 'kt-menu__item'
    ];

    /**
     * HTML опции элемента который содержит подменю
     * @var array
     */
    public $submemuItemOptions = [
        'class' => 'kt-menu__item kt-menu__item--submenu',
        'data-ktmenu-submenu-toggle' => 'hover'
    ];

    /**
     * Шаблон обычного элемента
     * @var string
     */
    public $linkTemplate = "
        <a href=\"{url}\" class='kt-menu__link'>
            {icon}
            <span class='kt-menu__link-text'>{label}</span>
            {badge}
        </a>
    ";

    /**
     * Шаблон элемента с подменю
     * @var string
     */
    public $submenuItemTemplate = "
        <a href=\"#\" class='kt-menu__link kt-menu__toggle'>
            {icon}
            <span class='kt-menu__link-text'>{label}</span>
            {badge}
            <span class='kt-menu__ver-arrow flaticon2-next'></span>
        </a>
    ";

    /**
     * шаблон подменю
     * @var string
     */
    public $submenuTemplate = "
        <div class='kt-menu__submenu'>
            <span class='kt-menu__arrow'></span>
            <ul class='kt-menu__subnav'>\n{items}\n</ul>
        </div>
    ";

    /**
     * Рендер элемента списка
     * @param array $item
     * @return string
     */
    protected function renderItem($item)
    {
        $icon = ArrayHelper::getValue($item, 'icon', null);
        if ($icon) {
            $icon = Html::tag("i", null, ['class' => $icon]);
        }

        if (isset($item['url'])) {
            return $this->renderRegularItem($item, $icon);
        }

        return $this->renderSubmenuItem($item, $icon);
    }

    /**
     * рендер обычного элемента списка
     * @param array $item
     * @param string $icon
     * @return string
     */
    protected function renderRegularItem($item, $icon)
    {
        $badge = ArrayHelper::getValue($item, 'badge', null);
        $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

        return strtr($template, [
            '{url}' => Html::encode(Url::to($item['url'])),
            '{label}' => $item['label'],
            '{icon}' => $icon,
            '{badge}' => $badge
        ]);
    }

    /**
     * рендер элемента подменю
     * @param array $item
     * @param string $icon
     * @return string
     */
    protected function renderSubmenuItem($item, $icon)
    {
        if (isset($item['items'])) {
            $item['options'] = $this->submemuItemOptions;
            $item['template'] = $this->submenuItemTemplate;
        }

        $badge = ArrayHelper::getValue($item, 'badge', null);
        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{label}' => $item['label'],
            '{icon}' => $icon,
            '{badge}' => $badge
        ]);
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return bool whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = Yii::getAlias($item['url'][0]);
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            $route_index_less = substr($this->route, 0, -6);
            if (ltrim($route, '/') !== $this->route && ltrim($route, '/') !== $route_index_less) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }
}
