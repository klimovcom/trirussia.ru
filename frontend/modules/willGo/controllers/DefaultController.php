<?php


namespace willGo\controllers;
use willGo\models\WillGo;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `race` module
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add-will-go' => ['post'],
                    'remove-will-go' => ['post'],
                ],
            ],

        ];
    }*/

    public function actionAddWillGo(){
        if (!empty($_POST['raceId'])){
            $model = new WillGo();
            $model->user_id = \Yii::$app->user->identity->id;
            $model->race_id = $_POST['raceId'];
            $model->save();
            return $model->race->attendance;
        }
        return 0;
    }

    public function actionRemoveWillGo(){
        if (!empty($_POST['raceId'])){
            $model = WillGo::find()
                ->where(['race_id' => $_POST['raceId'], 'user_id'=> \Yii::$app->user->identity->id])
                ->one();
            if ($model){
                $attendance = $model->race->attendance - 1;
                $model->delete();
                return $attendance;
            }
        }
        return 0;
    }
}
