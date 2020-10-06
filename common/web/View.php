<?php

namespace common\web;

use Yii;
use yii\web\IdentityInterface;

/**
 * Class View
 *
 * @package common\web
 *
 * @property-read IdentityInterface $user
 * @property-read array             $breadcrumbs
 */
class View extends \yii\web\View
{
    /**
     * набор ссылок действий для страницы
     *
     * @var array
     */
    protected $buttons = [];

    /**
     * хлебные крошки
     *
     * @return array
     */
    protected function getBreadcrumbs(): array
    {
        $items = $this->context->breadcrumbs;
        $items[] = $this->title;
        return $items;
    }

    /**
     * Текущий пользователь
     *
     * @return IdentityInterface
     */
    protected function getUser(): IdentityInterface
    {
        return Yii::$app->user->identity;
    }
}
