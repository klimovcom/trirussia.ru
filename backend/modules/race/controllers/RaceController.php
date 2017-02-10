<?php

namespace race\controllers;

use backend\components\BackController;
use distance\models\Distance;
use distance\models\DistanceCategory;
use distance\models\DistanceDistanceCategoryRef;
use Faker\Factory;
use Yii;
use race\models\Race;
use race\models\RaceSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RaceController implements the CRUD actions for Race model.
 */
class RaceController extends BackController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                ],
            ],
        ];
    }

    public function actions() {
        return [
            'image-upload' => [
                'class' => 'backend\extensions\UploadAction',
                'url' => '/uploads/misc/', // Directory URL address, where files are stored.
                'path' => Yii::getAlias('@backend/web/upload/misc/'), // Or absolute path to directory where files are stored.
                'width' => 800,
                'height' => 450,
            ],
        ];
    }

    /**
     * Lists all Race models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RaceSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Race model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Race model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Race();
        $model->published = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->sport_id = null;
            $model->setCategoriesArray(null);
            $model->setDistancesArray(null);
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Race model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Race model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param bool $ml
     * @return Race the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $ml = true)
    {
        if ($ml){
            if (($model = Race::find()->multilingual()->where(['id' => $id, ])->one()) !== null) {
                return $model;
            }
        } else {
            if (($model = Race::findOne($id)) !== null) {
                return $model;
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetCategoriesWidget()
    {
        $this->layout = false;
        $sportId = $_POST['sportId'];
        $options = DistanceCategory::find()->where(['sport_id' => $sportId, ])->all();
        return $this->renderAjax('_categories-widget', ['options' => $options, ]);
    }

    public function actionGetDistancesWidget()
    {
        $this->layout = false;
        $categoriesIdArray = $_POST['distanceCategories'];
        $distancesRefs = DistanceDistanceCategoryRef::find()
            ->where(['in', 'distance_category_id', $categoriesIdArray])
            ->all();
        $distances = ArrayHelper::map(Distance::find()->all(), 'id', 'label');
        $options = [];
        foreach($distancesRefs as $ref){
            $model = new Distance();
            $model->id = $ref->distance_id;
            $model->label = $distances[$ref->distance_id];
            $options[] = $model;
        }
        return $this->renderAjax('_categories-widget', ['options' => $options, ]);
    }
}
