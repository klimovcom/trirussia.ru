<?php

namespace user\controllers;

use common\models\UserInfo;
use Yii;
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
