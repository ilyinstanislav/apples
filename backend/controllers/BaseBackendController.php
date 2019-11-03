<?php

namespace backend\controllers;

use yii\web\Controller;

/**
 * Base backend controller
 */
class BaseBackendController extends Controller
{
    public $layout = 'main';
    protected $_breadcrumbs = [];

    /**
     * @return string
     */
    protected function getTitle()
    {
        return $this->view->title;
    }

    /**
     * @param string $value
     */
    protected function setTitle($value)
    {
        $this->view->title = $value;
    }

    /**
     * @return array
     */
    public function getBreadcrumbs()
    {
        return $this->_breadcrumbs;
    }
}
