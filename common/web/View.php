<?php

namespace common\web;

use Yii;
use yii\web\View as BaseComponent;

/**
 * Class View
 * @package common\web
 */
class View extends BaseComponent
{
    /**
     * набор ссылок действий для страницы
     * @var array
     */
    protected $buttons = [];

    /**
     * хлебные крошки
     * @return array
     */
    protected function getBreadcrumbs()
    {
        $items = $this->context->breadcrumbs;
        $items[] = $this->title;
        return $items;
    }

    /**
     * Текущий пользователь
     * @return null|User
     */
    protected function getUser()
    {
        return Yii::$app->user->identity;
    }
}
