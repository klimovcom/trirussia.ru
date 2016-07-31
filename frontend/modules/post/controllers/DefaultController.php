<?php

namespace post\controllers;

use post\models\Post;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * @param $url
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($url)
    {
        $model = Post::find()->where(['url' => $url])->one();
        /** @var $model Post */
        $model->addStatisticsView();
        
        if (!$model){
            throw new NotFoundHttpException();
        }

        return $this->render('view', ['post' => $model, ]);
    }
}
