<?php

namespace backend\controllers;

use backend\models\forms\EatForm;
use backend\models\Apple;
use common\helpers\Helper;
use common\models\catalogs\AppleColors;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
                        'actions' => ['index', 'generate-new', 'eat', 'fall', 'remove', 'isset'],
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
     * Падение яблока на землю
     * @param $id
     * @return Response
     */
    public function actionFall($id)
    {
        $apple = Apple::findOne($id);

        if ($apple && !$apple->isFalled) {
            $apple->fallToGround();
        }

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Удаление яблока
     * @param $id
     * @return array|Response
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionRemove($id)
    {
        $apple = Apple::findOne($id);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!$apple) {
            return ['success' => false];
        }

        if ($apple->delete()) {
            return Yii::$app->request->isAjax ? ['success' => true] : $this->redirect(Yii::$app->request->referrer);
        }

        return Yii::$app->request->isAjax ? ['success' => false] : $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Проверка существования яблока
     * @param $id
     * @return array
     */
    public function actionIsset($id)
    {
        $apple = Apple::findOne($id);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['isset' => $apple ? true : false];
    }

    /**
     * Кусание яблока
     * @param $id
     * @return array|bool
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionEat($id)
    {
        $model = new EatForm([
            'id' => $id
        ]);

        $model->load(Yii::$app->request->post());

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if (!$model->validate()) {
                return ActiveForm::validate($model);
            }
            if ($model->save()) {
                return [];
            }
        }
        return false;
    }

    /**
     * Список яблок с действиями.
     * @return string
     */
    public function actionIndex()
    {
        $this->title = 'Эксперименты с яблоками';

        $apples = Apple::find()->all();
        $model = new EatForm();

        return $this->render('index', compact('apples', 'model'));
    }

    /**
     * Генерирование нового списка яблок
     * @return Response
     */
    public function actionGenerateNew()
    {
        Apple::deleteAll();
        $num_apples = rand(3, 9);

        for ($i = $num_apples; $i > 0; $i--) {
            $recent = new Apple([
                'color' => AppleColors::getRandom(),
                'dt_create' => Helper::getRandomTimeStamp(),
            ]);
            $recent->save();
        }

        Yii::$app->session->setFlash('success', 'Яблоки успешно сгенерированы');
        return $this->redirect(Yii::$app->request->referrer);
    }


}
