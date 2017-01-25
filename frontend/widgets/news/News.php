<?php
namespace frontend\widgets\news;
use post\models\Post;

/**
 * Class News
 * @package frontend\widgets\news
 */
class News extends \yii\base\Widget{

    public $models = [];
    
    public $header;

    public function run(){
        $news = Post::find()->orderBy('created DESC')->published()->limit(5)->all();
        if (!empty($news))
            return $this->render('default', ['news' => $news, ]);
    }
}