<?php
namespace frontend\widgets\mostPopularPosts;
use post\models\Post;


/**
 * Class MostPopularPosts
 * @package frontend\widgets\mostPopularPost
 */
class MostPopularPosts extends \yii\base\Widget{

    public $models;

    public function run(){
        if (!$this->models)
            $this->models = Post::find()
                ->published()
                ->orderBy('popularity DESC')
                ->limit(6)
                ->offset(1)
                ->all();

        return $this->render('default', ['posts' => $this->models, ]);
    }
}