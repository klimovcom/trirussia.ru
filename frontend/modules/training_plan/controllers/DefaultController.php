<?php

namespace training_plan\controllers;

use sport\models\Sport;
use Yii;
use training_plan\models\TrainingPlan;
use training_plan\models\TrainingPlanSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for TrainingPlan model.
 */
class DefaultController extends Controller
{
    public function actionIndex($sort = null, $sport_name = null, $level = null, $format = null) {

        $query = TrainingPlan::find();

        if ($sport_name != 'all') {
            $sport = Sport::find()->where(['label' => $sport_name])->published()->one();
            if ($sport) {
                $query->where(['sport_id' => $sport->id]);
            }
        }

        if ($level != 'all') {
            $levelArray = array_flip(TrainingPlan::getLevelArray());
            if (ArrayHelper::getValue($levelArray, $level)) {
                $query->where(['level' => ArrayHelper::getValue($levelArray, $level)]);
            }
        }

        if ($format != 'all') {
            $formatArray = array_flip(TrainingPlan::getFormatArray());
            if (ArrayHelper::getValue($formatArray, $format)) {
                $query->where(['format' => ArrayHelper::getValue($formatArray, $format)]);
            }
        }

        $query->published();

        if ($sort == 'price') {
            $query->orderBy(['price' => SORT_ASC]);
        }else {
            $query->orderBy(['popularity' => SORT_DESC]);
        }

        $models = $query->all();

        $sports = Sport::find()->published()->all();

        return $this->render('index', [
            'models' => $models,
            'sports' => $sports,
            'sort' => $sort,
            'sport_name' => $sport_name,
            'level' => $level,
            'format' => $format,
        ]);
    }

    public function actionView($url) {
        $model = $this->findModel($url);

        $model->updateCounters(['popularity' => 1]);

        $additionalModels = TrainingPlan::find()->where(['sport_id' => $model->sport_id])->andWhere(['not', ['id' => $model->id]])->published()->orderBy(['popularity' => SORT_DESC])->limit(4)->all();

        return $this->render('view', [
            'model' => $model,
            'additionalModels' => $additionalModels,
        ]);
    }

    public function findModel($url)
    {
        if (($model = TrainingPlan::find()->where(['url' => $url])->published()->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
