<?php

namespace post\controllers;

use post\models\Post;
use seo\models\Seo;
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
        $featured = Post::find()->where(['featured'=>1])->orderBy('created DESC, id DESC')->one();

        $posts = Post::find()->orderBy('created DESC')->limit(9)->offset(5)->all();
        
        return $this->render('index', ['featured' => $featured, 'posts' => $posts, ]);
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

        Seo::registerModel($model);
        
        if (!$model){
            throw new NotFoundHttpException();
        }



        return $this->render('view', ['post' => $model, ]);
    }
}
