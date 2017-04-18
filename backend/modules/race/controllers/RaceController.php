<?php

namespace race\controllers;

use backend\components\BackController;
use common\models\UserInfo;
use distance\models\Distance;
use distance\models\DistanceCategory;
use distance\models\DistanceDistanceCategoryRef;
use Faker\Factory;
use race\models\RaceFpmFile;
use race\models\RaceRegistration;
use Yii;
use race\models\Race;
use race\models\RaceSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
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
                'path' => Yii::getAlias('@backend/web/uploads/misc/'), // Or absolute path to directory where files are stored.
                'width' => 1200,
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
            if (($model = Race::find()->multilingual()->where(['id' => $id, ])->forUser()->one()) !== null) {
                return $model;
            }
        } else {
            if (($model = Race::find()->where(['id' => $id])->forUser()->one()) !== null) {
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

    public function actionDeleteFile() {
        $race_id = Yii::$app->request->post('race_id');
        $file_id = Yii::$app->request->post('file_id');
        $file = RaceFpmFile::find()->where(['race_id' => $race_id, 'fpm_file_id' => $file_id])->one();
        $file->delete();
    }

    public function actionRegistered($id) {
        $model = $this->findModel($id);
        $users = $model->registeredUsers;
        $dataProvider = new ActiveDataProvider([
            'query' => UserInfo::find()->where(['user_id' => ArrayHelper::getColumn($users, 'id')]),
            'pagination' => false,
        ]);
        return $this->render('registered_index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}
