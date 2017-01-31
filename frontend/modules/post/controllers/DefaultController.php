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
        $simularPosts = Post::find()->where(['or like', 'tags', $tags])->andWhere(['!=', 'id', $model->id])->published()->all();
        $simularPostsArray = [];
        foreach ($simularPosts as $post) {
            $postTags = explode(',', $post->tags);
            $intersectCount = count(array_intersect($tags, $postTags));
            $simularPostsArray[] = ['post' => $post, 'intersectCount' => $intersectCount, 'popularity' => $post->popularity];
        }
        ArrayHelper::multisort($simularPostsArray, ['intersectCount', 'popularity'], [SORT_DESC, SORT_DESC]);

        $mostPopularPosts = Post::find()->where(['!=', 'id', $model->id])->published()->orderBy(['popularity' => SORT_DESC])->limit(3)->all();

        $mostPopularPostsText = $this->renderPartial('_most_popular', [
            'posts' => $mostPopularPosts,
        ]);

        preg_match_all("/<\/p>/", utf8_decode($model->content), $matches, PREG_OFFSET_CAPTURE);
        $pos = ArrayHelper::getValue($matches, '0.2.1');
        if ($pos) {
            $content = mb_substr($model->content, 0, $pos+4) . $mostPopularPostsText . mb_substr($model->content, $pos+4);
        }else {
            $content = $model->content . $mostPopularPostsText;
        }
        /** @var $model Post */
        $model->addStatisticsView();

        Seo::registerModel($model);

        return $this->render('view', [
            'post' => $model,
            'simularPostsArray' => $simularPostsArray,
            'mostPopularPosts' => $mostPopularPosts,
            'content' => $content,
        ]);
    }
    public function actionSearch()
    {
        $tag = $_GET['tag'];

        $posts = Post::find()->where("tags LIKE('%$tag%')")->all();

        $model = new Post();
        $model->tags = $tag;
        Seo::registerModel($model);


        return $this->render('search', ['posts' => $posts, ]);
    }

}
