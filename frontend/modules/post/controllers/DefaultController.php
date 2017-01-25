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
        $featured = Post::find()->where(['featured'=>1])->published()->orderBy('created DESC, id DESC')->one();

        $posts = Post::find()->orderBy('created DESC')->published()->limit(9)->offset(5)->all();
        
        return $this->render('index', ['featured' => $featured, 'posts' => $posts, ]);
    }


    /**
     * @param $url
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($url)
    {
        $model = Post::find()->where(['url' => $url])->published()->one();

        if (!$model){
            throw new NotFoundHttpException();
        }

        /** @var $model Post */
        $model->addStatisticsView();

        Seo::registerModel($model);

        return $this->render('view', ['post' => $model, ]);
    }
    public function actionSearch()
    {
        $tag = $_GET['tag'];

        $posts = Post::find()->where("tags LIKE('%$tag%')")->all();


        return $this->render('search', ['posts' => $posts, ]);
    }

}
