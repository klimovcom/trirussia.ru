<?php

namespace api\modules\race;

use yii\helpers\ArrayHelper;

class RaceModule extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\race\controllers';

    public function init()
    {
        parent::init();

        $this->setComponents(ArrayHelper::merge($this->getComponents(), [
            'race.manager' => [
                'class' => 'api\modules\race\components\RaceManager',
            ]
        ]));
    }
}
