<?php

namespace training\controllers;

use Yii;
use sport\models\Sport;
use training\models\Training;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `training` module
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
                            'create',
                        ],
                        'allow'   => true,
                        'roles'   => [ '@' ],
                    ],
                    [
                        'actions' => [
                            'index',
                        ],
                        'allow'   => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($sport_name = null)
    {

        $query = Training::find()->where(['>', 'date', date('Y-m-d', time())]);

        if ($sport_name != 'all') {
            $sport = Sport::find()->where(['label' => $sport_name])->published()->one();
            if ($sport) {
                $query->andWhere(['sport_id' => $sport->id]);
            }
        }

        $models = $query->published()->orderBy(['date' => SORT_ASC])->all();

        $sports = Sport::find()->published()->all();

        return $this->render('index', [
            'models' => $models,
            'sports' => $sports,
            'sport_name' => $sport_name,
        ]);
    }

    public function actionCreate() {
        $model = new Training();
        $model->currency = Training::CURRENCY_RUBBLE;
        $model->published = 1;
        $model->author_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('trainer-create-success', 'Данные успешно сохраненны');
            $model = new $model;

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
