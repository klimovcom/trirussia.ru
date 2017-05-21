<?php

namespace organizer\controllers;

use Yii;
use organizer\models\Organizer;
use race\models\Race;
use yii\web\Controller;
use yii\helpers\Json;

/**
 * Default controller for the `organizer` module
 */
class DefaultController extends Controller
{

    const PAGINATION_LIMIT = 30;

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $organizers = $this->getOrganizers(0);
        $showMore = false;
        if (count($organizers) == self::PAGINATION_LIMIT) {
            $showMore = true;
        }
        return $this->render('index', [
            'organizers' => $organizers,
            'showMore' => $showMore,
            'paginationLimit' => self::PAGINATION_LIMIT,
        ]);
    }

    public function actionGetMoreOrganizers() {
        $page = (int) Yii::$app->request->post('page');
        $result = '';
        if ($page) {
            $organizers = $this->getOrganizers(self::PAGINATION_LIMIT * $page);

            foreach ($organizers as $model) {
                $result .= $this->renderPartial('includes/card', [
                    'model' => $model,
                ]);
            }
        }
        return Json::encode([
            'result' => count($organizers),
            'data' => $result,
        ]);
    }

    public function getOrganizers($offset) {
        $subquery = Race::find()->select(['organizer_id', 'COUNT(organizer_id) AS race_count'])->published()->groupBy('organizer_id');

        $organizers = Organizer::find()
            ->select(['organizer.*', 'race_count'])
            ->leftJoin(['race_count' => $subquery], 'race_count.organizer_id = id')
            ->orderBy(['race_count' => SORT_DESC])
            ->published()
            ->limit(self::PAGINATION_LIMIT)
            ->offset($offset)
            ->all();

        return $organizers;
    }
}
