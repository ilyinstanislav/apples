<?php

namespace backend\controllers;

use common\models\Apple;
use common\models\catalogs\AppleColors;
use Yii;
use yii\filters\AccessControl;

/**
 * Apple controller
 */
class ApplesController extends BaseBackendController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'generate-new'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->title = 'Эксперименты с яблоками';

        $apples = Apple::find()->all();

        return $this->render('index', compact('apples'));
    }

    /**
     * Генерирование нового списка яблок
     */
    public function actionGenerateNew()
    {
        Apple::deleteAll();
        $num_apples = rand(3, 9);

        for ($i = $num_apples; $i > 0; $i--) {
            $recent = new Apple([
                'color' => AppleColors::getRandom(),
            ]);
            $recent->save();
        }


        Yii::$app->session->setFlash('success', 'Яблоки успешно сгенерированы');
        return $this->redirect(Yii::$app->request->referrer);
    }
}
