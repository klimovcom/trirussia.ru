<?php

namespace post\controllers;

use post\models\Post;
use seo\models\Seo;
use yii\helpers\ArrayHelper;
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

        $tags = explode(',', $model->tags);
        $simularPosts = Post::find()->where(['or like', 'tags', $tags])->andWhere(['!=', 'id', $model->id])->all();
        $simularPostsArray = [];
        foreach ($simularPosts as $post) {
            $postTags = explode(',', $post->tags);
            $intersectCount = count(array_intersect($tags, $postTags));
            $simularPostsArray[] = ['post' => $post, 'intersectCount' => $intersectCount, 'popularity' => $post->popularity];
        }
        ArrayHelper::multisort($simularPostsArray, ['intersectCount', 'popularity'], [SORT_DESC, SORT_DESC]);

        /** @var $model Post */
        $model->addStatisticsView();

        Seo::registerModel($model);

        return $this->render('view', [
            'post' => $model,
            'simularPostsArray' => $simularPostsArray,
        ]);
    }
    public function actionSearch()
    {
        $tag = $_GET['tag'];

        $posts = Post::find()->where("tags LIKE('%$tag%')")->all();


        return $this->render('search', ['posts' => $posts, ]);
    }

}
