<?php

namespace organizer\controllers;

use organizer\models\Organizer;
use yii\web\Controller;

/**
 * Default controller for the `organizer` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $organizers = Organizer::find()->where(['is not', 'image_id', null])->andWhere(['not', ['image_id' => 0]])->published()->all();
        return $this->render('index', [
            'organizers' => $organizers,
        ]);
    }
}
