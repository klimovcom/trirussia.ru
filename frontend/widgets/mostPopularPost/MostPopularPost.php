<?php
namespace frontend\widgets\mostPopularPost;
use post\models\Post;


/**
 * Class MostPopularPost
 * @package frontend\widgets\mostPopularPost
 */
class MostPopularPost extends \yii\base\Widget{

    public $model;

    public function run(){
        $this->model = Post::find()
            ->orderBy('popularity DESC')
            ->limit(1)
            ->one();

        return $this->render('default', ['post' => $this->model, ]);
    }
}