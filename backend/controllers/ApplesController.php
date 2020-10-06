<?php

namespace backend\controllers;

use backend\models\forms\EatForm;
use common\models\Apple;
use common\models\catalogs\AppleColors;
use common\models\catalogs\AppleStatuses;
use Exception;
use Throwable;
use Yii;
use yii\db\Expression;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\ErrorAction;

/**
 * Apples controller
 *
 * @property-read array $breadcrumbs
 */
class ApplesController extends Controller
{
    public $layout = 'main';
    protected $_breadcrumbs = [];

    /**
     * @return array
     */
    public function getBreadcrumbs(): array
    {
        return $this->_breadcrumbs;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Падение яблока на землю
     *
     * @param $id
     *
     * @return Response
     */
    public function actionFall($id)
    {
        $apple = Apple::find()->byId($id)->one();

        if ($apple && !$apple->isFalled) {
            $apple->status = AppleStatuses::FALL;
            $apple->dt_fall = new Expression('NOW()');
            $apple->save(true, ['status', 'dt_fall']);
        }

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Удаление яблока
     *
     * @param $id
     *
     * @return array|Response
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionRemove($id)
    {
        $apple = Apple::find()->byId($id)->one();

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
     *
     * @param $id
     *
     * @return array
     */
    public function actionIsset($id): array
    {
        $apple = Apple::find()->byId($id)->one();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['isset' => $apple ? true : false];
    }

    /**
     * Кусание яблока
     *
     * @param $id
     *
     * @return array|bool
     * @throws StaleObjectException
     * @throws Throwable
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
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $apples = Apple::find()->all();
        $model = new EatForm();

        return $this->render('index', compact('apples', 'model'));
    }

    /**
     * Генерирование новых яблок
     *
     * @return Response
     * @throws Exception
     */
    public function actionGenerateNew(): Response
    {
        Apple::deleteAll();

        for ($i = random_int(3, 9); $i > 0; $i--) {
            $recent = new Apple([
                'color' => AppleColors::getRandom(),
                'dt_create' => date('Y-m-d H-i-s', random_int(time() - 86400 * 365, time())),
            ]);

            $recent->save();
        }

        Yii::$app->session->setFlash('success', 'Яблоки успешно сгенерированы');

        return $this->redirect(Yii::$app->request->referrer);
    }
}
