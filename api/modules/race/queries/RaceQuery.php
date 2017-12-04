<?php
namespace api\modules\race\queries;

use Yii;
use yii\db\ActiveQuery;

class RaceQuery extends ActiveQuery {

    public function published()
    {
        return $this->andWhere(['published' => 1]);
    }

    public function future()
    {
        return $this->andWhere(['>=', 'start_date', date('Y-m-d', time())]);
    }

    public function forUser()
    {
        if (Yii::$app->user->isGuest) {
            return $this->andWhere(['published' => 1]);
        }
        return $this->andWhere(['or', ['published' => 1], ['and', ['published' => 0], ['author_id' => Yii::$app->user->id]]]);
    }

}