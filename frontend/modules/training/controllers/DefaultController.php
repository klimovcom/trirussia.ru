<?php

namespace training\controllers;

use training\models\TrainingPlace;
use Yii;
use sport\models\Sport;
use training\models\Training;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Html;
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
    public function actionIndex($sport_name = null, $trainer = null, $place = null)
    {

        $query = Training::find()->where(['>', 'date', date('Y-m-d', time())]);

        if ($sport_name != 'all') {
            $sport = Sport::find()->where(['label' => $sport_name])->published()->one();
            if ($sport) {
                $query->andWhere(['sport_id' => $sport->id]);
            }
        }

        if ($trainer) {
            $query->andWhere(['trainer_name' => $trainer]);
        }

        if ($place) {
            $placeModel = TrainingPlace::find()->where(['label' => $place])->one();
            if ($placeModel) {
                $query->andWhere(['place_id' => $placeModel->id]);
            }else {
                $place = null;
            }
        }

        $models = $query->published()->orderBy(['date' => SORT_ASC])->all();

        $sports = Sport::find()->published()->all();

        if (Yii::$app->cache->exists('training_authors')) {
            $authors = Yii::$app->cache->get('training_authors');
        }else {
            $authors = (new Query())->
                select(['trainer_name', 'COUNT(trainer_name) as training_count', 'date'])
                ->from(Training::tableName())
                ->where(['published' => 1])
                ->andWhere(['>', 'date', date('Y-m-d', time())])
                ->groupBy(['trainer_name'])
                ->orderBy(['training_count' => SORT_DESC])
                ->limit(10)
                ->all();
            Yii::$app->cache->set('training_authors', $authors, 60 * 60);
        }

        if (Yii::$app->cache->exists('training_places')) {
            $places = Yii::$app->cache->get('training_places');
        }else {
            $places = (new Query())->
                select(['place_id', 'COUNT(place_id) as place_count', TrainingPlace::tableName() .'.label', Training::tableName() . '.date'])
                ->from(TrainingPlace::tableName())
                ->leftJoin(Training::tableName(), TrainingPlace::tableName() . '.id =' . Training::tableName() . '.place_id')
                ->where([Training::tableName() . '.published' => 1])
                ->andWhere(['>', Training::tableName() . '.date', date('Y-m-d', time())])
                ->groupBy(['place_id'])
                ->orderBy(['place_count' => SORT_DESC])
                ->limit(10)
                ->all();
            Yii::$app->cache->set('training_places', $places, 60 * 60);
        }


        return $this->render('index', [
            'models' => $models,
            'sports' => $sports,
            'sport_name' => $sport_name,
            'authors' => $authors,
            'places' => $places,
            'trainer' => $trainer,
            'place' => $place,
        ]);
    }

    public function actionCreate() {
        $model = new Training();
        $model->currency = Training::CURRENCY_RUBBLE;
        $model->published = 1;
        $model->author_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('trainer-create-success', 'Данные успешно сохраненны, ' . Html::a('Предстоящие тренировки', ['/training/default/index'], ['class' => 'underline']));
            $model = new $model;

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
