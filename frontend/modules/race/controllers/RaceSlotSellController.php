<?php

namespace race\controllers;

use distance\models\Distance;
use race\models\Race;
use race\models\RaceDistanceRef;
use race\models\RaceSlotSell;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class RaceSlotSellController extends Controller
{
    public function actionIndex() {

        $offers = RaceSlotSell::find()->joinWith('race')->where(['>=', 'race.start_date', date('Y-m-d', time())])->all();
        $races = ArrayHelper::index(Race::find()->where(['id' => ArrayHelper::getColumn($offers, 'race_id')])->all(), 'id');
        $distances = ArrayHelper::index(Distance::find()->where(['id' => ArrayHelper::getColumn($offers, 'distance_id')])->all(), 'id');

        $offers = ArrayHelper::index($offers, null, 'type');

        return $this->render('index', [
            'offers' => $offers,
            'races' => $races,
            'distances' => $distances,
        ]);
    }

    public function actionCreate() {
        $result['status'] = 'error';

        $user_id = Yii::$app->user->id;

        if (!$user_id) {
            $result['message'] = 'Для выполнения этой операции нужно быть зарегистрированным пользователем';
            return Json::encode($result);
        }

        $race_id = Yii::$app->request->post('race_id');
        $distance_id = Yii::$app->request->post('distance_id');
        $price = Yii::$app->request->post('price');
        $type = Yii::$app->request->post('type');

        if ($type != RaceSlotSell::TYPE_SELL) {
            $type = RaceSlotSell::TYPE_BUY;
        }

        if (!$price) {
            $result['message'] = 'Укажите цену';
            return Json::encode($result);
        }

        $raceDistance = RaceDistanceRef::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'type' => RaceDistanceRef::TYPE_RACE])->one();

        if (!$raceDistance) {
            $result['message'] = 'Неверная дистанция';
            return Json::encode($result);
        }

        $raceSlotSell = RaceSlotSell::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'type' => $type, 'user_id' => $user_id])->one();
        if ($raceSlotSell) {
            $result['message'] = 'Вы не можете оставлять несколько заявок на один забег';
            return Json::encode($result);
        }
        $raceSlotSell = new RaceSlotSell();
        $raceSlotSell->user_id = $user_id;
        $raceSlotSell->race_id = $race_id;
        $raceSlotSell->distance_id = $distance_id;
        $raceSlotSell->type = $type;
        $raceSlotSell->price = $price;

        if ($raceSlotSell->save()) {
            $result['status'] = 'success';
            $result['message'] = 'Заявка успешно добавлена';
            $result['content'] = $this->renderListItem($race_id, $distance_id, $type);
        }else {
            $result['message'] = 'Произошла ошибка, попробуйте повторите позднее';
        }

        return Json::encode($result);
    }

    public function actionDelete() {
        $race_id = Yii::$app->request->post('race_id');
        $distance_id = Yii::$app->request->post('distance_id');
        $user_id = Yii::$app->request->post('user_id');
        $type = Yii::$app->request->post('type');

        $result['status'] = 'error';

        if (Yii::$app->user->id != $user_id) {
            $result['message'] = 'Вы не можете удалить данную запись';
            return Json::encode($result);
        }

        RaceSlotSell::deleteAll(['race_id' => $race_id, 'distance_id' => $distance_id, 'user_id' => $user_id, 'type' => $type]);

        $listItem = $this->renderListItem($race_id, $distance_id, $type);

        if ($listItem === false) {
            $result['message'] = 'Произошла ошибка, попробуйте повторите позднее';
        }

        $result['status'] = 'success';
        $result['message'] = $listItem;

        return Json::encode($result);
    }

    public function actionFindRace($q) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['results' => ['id' => '', 'label' => '']];

        if (!is_null($q)) {
            $query = new Query();
            $query->select('id, label')
                ->from(Race::tableName())
                ->where(['like', 'label', $q])
                ->andWhere(['>=', 'start_date', date('Y-m-d', time())])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $result['results'] = array_values($data);
        }
        return $result;
    }

    public function actionFindDistance() {
        $race_id = Yii::$app->request->post('race_id');
        if ($race_id !== false) {
            $race = Race::find()->where(['id' => $race_id])->one();

            if ($race) {
                $raceDistances = RaceDistanceRef::find()->where(['race_id' => $race_id, 'type' => RaceDistanceRef::TYPE_RACE])->all();

                $raceDistancesArray = [];
                foreach ($raceDistances as $raceDistance) {
                    $raceDistancesArray[$raceDistance->distance_id] = $raceDistance->distance->label;
                }
                return Json::encode(['status'=> 'success', 'content' => Html::dropDownList('distance_id', $raceDistancesArray, [], ['id' => 'race-slot-sell-modal-distance_id', 'class' => 'c-select'])]);
            }
        }
        return Json::encode(['status'=> 'error', 'content' => '']);
    }

    public function actionGetModal() {
        $type = Yii::$app->request->post('type');

        if ($type == RaceSlotSell::TYPE_SELL) {
            $result['header'] = 'Добавить слот на продажу';
            $result['content'] = $this->renderAjax('modal_sell_content', [
                'type' => RaceSlotSell::TYPE_SELL,
            ]);
        }else {
            $result['header'] = 'Добавить заявку на покупку слота';
            $result['content'] = $this->renderAjax('modal_sell_content', [
                'type' => RaceSlotSell::TYPE_BUY,
            ]);
        }
        return Json::encode($result);
    }

    public function actionGetUserModal() {
        $race_id = Yii::$app->request->post('race_id');
        $distance_id = Yii::$app->request->post('distance_id');
        $user_id = Yii::$app->request->post('user_id');
        $type = Yii::$app->request->post('type');

        $result['status'] = 'error';
        $result['header'] = 'Продажа слотов';

        if (Yii::$app->user->isGuest) {
            return Json::encode($result);
        }

        $offer = RaceSlotSell::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'user_id' => $user_id, 'type' => $type])->one();

        if (!$offer) {
            $result['message'] = 'К сожалению, пользователь удалил свою заявку';
            return Json::encode($result);
        }

        $result['status'] = 'success';
        $result['message'] = $this->renderPartial('_user_info', [
            'offer' => $offer,
        ]);

        return Json::encode($result);
    }

    public function renderListItem($race_id, $distance_id, $type) {
        $race = Race::find()->where(['id' => $race_id])->one();
        $distance = Distance::find()->where(['id' => $distance_id])->one();
        if (!$race || !$distance) {
            return false;
        }
        $slots = RaceSlotSell::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'type' => $type])->all();

        return $this->renderPartial('_list_item', [
            'race' => $race,
            'distance' => $distance,
            'slots' => $slots,
            'type' => $type,
        ]);
    }
}
