<?php

namespace user\controllers;

use common\models\UserInfo;
use race\models\Race;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'about',
                        ],
                        'allow'   => true,
                        'roles'   => [ '@' ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout() {
        $model = Yii::$app->user->identity->userInfo;
        if (!$model) {
            $model = new UserInfo();
            $model->user_id = Yii::$app->user->id;
            $model->setDefaultInfo();
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $race_cookie = Yii::$app->request->cookies->get('register-to-race');
                if ($race_cookie) {
                    $info = json_decode($race_cookie);
                    $race_id = ArrayHelper::getValue($info, 'race_id');
                    $distance_id = ArrayHelper::getValue($info, 'distance_id');
                    $type = ArrayHelper::getValue($info, 'type');
                    if ($race_id && $distance_id && $type) {
                        Yii::$app->response->cookies->remove('register-to-race');
                        $race = Race::find()->where(['id' => $race_id])->forUser()->one();
                        if ($race) {
                            $race->registerUser($distance_id, $type);
                            return $this->redirect(['/race/default/view', 'url' => $race->url]);
                        }
                    }
                }
                Yii::$app->session->setFlash('success', 'Данные успешно обновленны');
            }else {
                Yii::$app->session->setFlash('danger', 'Не удалось сохранить данные, попробуйте позднее');
            }

        }

        return $this->render('about', [
            'model' => $model,
        ]);
    }
}
