<?php

namespace race\controllers;

use race\models\RaceRelayRegistration;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use race\models\Race;
use race\models\RaceDistanceRef;
use race\models\RaceRelay;

class RaceRelayRegistrationController extends Controller
{

    public function actionCreate() {
        $user_id = Yii::$app->user->id;

        $sendMessage = false;

        $result = [
            'status' => 'error',
            'message' => '',
        ];

        if ($user_id === null) {
            return Json::encode($result);
        }

        $race_id = Yii::$app->request->post('race_id');
        $distance_id = Yii::$app->request->post('distance_id');
        $position = Yii::$app->request->post('position');
        $group = Yii::$app->request->post('group');
        $time = Yii::$app->request->post('time');
        $is_first = 0;

        if (!$time) {
            $result['message'] = 'Введите время за которое вы пройдете этап';
            return Json::encode($result);
        }


        $raceRelay = RaceRelay::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'position' => $position])->one();

        if ($raceRelay === null) {
            return Json::encode($result);
        }

        $registrationCount = RaceRelayRegistration::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'user_id' => $user_id])->count();

        if ($registrationCount >= RaceRelayRegistration::LIMIT_REGISTRATION_FOR_RELAY) {
            $result['message'] = 'Превышен лимит регистраций на эстафету';
            return Json::encode($result);
        }

        if ($group == 0) {
            $is_first = 1;
            $group = RaceRelayRegistration::find()->select(['group'])->where(['race_id' => $race_id, 'distance_id' => $distance_id])->orderBy(['group' => SORT_DESC])->limit(1)->scalar() + 1;
        }else {
            $registration = RaceRelayRegistration::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'user_id' => $user_id, 'group' => $group, 'position' => $position])->one();
            if ($registration) {
                $result['message'] = 'Вы уже зарегистрированы на данный этап';
                return Json::encode($result);
            }

            $positionCount = RaceRelay::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id])->count();
            $registrationInGroupCount = RaceRelayRegistration::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'user_id' => $user_id, 'group' => $group])->count();

            if (($registrationInGroupCount + 1) == $positionCount) {
                $result['message'] = 'Вы не можете взять все этапы эстафеты';
                return Json::encode($result);
            }

            $first_user = RaceRelayRegistration::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'is_first' => 1, 'group' => $group])->one();
            if ($first_user->id !== $user_id) {
                $sendMessage = true;
            }

        }

        $registration = new RaceRelayRegistration();
        $registration->race_id = $race_id;
        $registration->distance_id = $distance_id;
        $registration->user_id = $user_id;
        $registration->position = $position;
        $registration->group = $group;
        $registration->time = $time;
        $registration->is_first = $is_first;

        if ($registration->save()) {
            if ($sendMessage) {
                Yii::$app->mailer->compose(['html' => 'race-relay-join'], [
                    'first_user_name' => $first_user->first_name,
                    'user_name' => Yii::$app->user->last_name . ' ' . Yii::$app->user->first_name,
                    'user_email' => Yii::$app->user->email,
                    'race_label' => $first_user->race->label,
                    'time' => $time,
                    'sport' => RaceRelay::getSportArray()[$raceRelay->sport],
                    'race_url' => Url::to(['/race/default/view', 'url' => $first_user->race->url], true),
                ])
                    ->setFrom('no-reply@trirussia.ru')
                    ->setTo($first_user->email)
                    ->setSubject('Пользователь оставил заявку на участие в эстафете в вашей команде на соревновании ' . $first_user->race->label)
                    ->send();
            }


            $result['status'] = 'success';
            $result['message'] = $this->renderModal($race_id, $distance_id);
            return Json::encode($result);
        }

        $result['message'] = 'Произошла ошибка, пожалуйста повторите позднее';
        return Json::encode($result);
    }

    public function actionDelete() {
        $result = [
            'status' => 'error',
            'message' => '',
        ];
        $user_id = Yii::$app->user->id;

        $race_id = Yii::$app->request->post('race_id');
        $distance_id = Yii::$app->request->post('distance_id');
        $group = Yii::$app->request->post('group');
        $position = Yii::$app->request->post('position');

        $raceRegistration = RaceRelayRegistration::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'group' => $group, 'position' => $position])->one();

        if ($raceRegistration === null) {
            return false;
        }

        $first_registration = RaceRelayRegistration::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'group' => $group, 'is_first' => true])->one();

        if ($user_id == $first_registration->user_id) {

            if ($raceRegistration->is_first = 1) {
                $registrationToDelete = RaceRelayRegistration::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'group' => $group, 'not' => ['id' => $raceRegistration->user_id]])->all();
                foreach ($registrationToDelete as $reg) {

                    $raceRelay = RaceRelay::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'position' => $reg->position])->one();

                    Yii::$app->mailer->compose(['html' => 'race-relay-join'], [
                        'first_user_name' => Yii::$app->user->last_name . ' ' . Yii::$app->user->first_name,
                        'user_name' => $reg->user->first_name,
                        'race_label' => $first_registration->race->label,
                        'sport' => RaceRelay::getSportArray()[$raceRelay->sport],
                        'race_url' => Url::to(['/race/default/view', 'url' => $first_registration->race->url], true),
                    ])
                        ->setFrom('no-reply@trirussia.ru')
                        ->setTo(Yii::$app->user->email)
                        ->setSubject('Капитан удалил вас с этапа эстафеты ' . $first_registration->race->label)
                        ->send();
                }
                RaceRelayRegistration::deleteAll(['race_id' => $race_id, 'distance_id' => $distance_id, 'group' => $group]);
            }else {
                $raceRelay = RaceRelay::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'position' => $raceRegistration->position])->one();

                Yii::$app->mailer->compose(['html' => 'race-relay-join'], [
                    'first_user_name' => Yii::$app->user->last_name . ' ' . Yii::$app->user->first_name,
                    'user_name' => $raceRegistration->user->first_name,
                    'race_label' => $first_registration->race->label,
                    'sport' => RaceRelay::getSportArray()[$raceRelay->sport],
                    'race_url' => Url::to(['/race/default/view', 'url' => $first_registration->race->url], true),
                ])
                    ->setFrom('no-reply@trirussia.ru')
                    ->setTo(Yii::$app->user->email)
                    ->setSubject('Капитан удалил вас с этапа эстафеты ' . $first_registration->race->label)
                    ->send();

                $raceRegistration->delete();
            }

            $result['status'] = 'success';
            $result['message'] = $this->renderModal($race_id, $distance_id);
            return Json::encode($result);
        }

        if ($user_id == $raceRegistration->user_id) {
            $raceRegistration->delete();
            $result['status'] = 'success';
            $result['message'] = $this->renderModal($race_id, $distance_id);
            return Json::encode($result);
        }

        $result['message'] = 'Вы не можете удалить этого участника из эстафеты';
        return Json::encode($result);
    }


    public function actionGetRelayModal() {
        $race_id = Yii::$app->request->post('race_id');
        $distance_id = Yii::$app->request->post('distance_id');

        return $this->renderModal($race_id, $distance_id);
    }

    private function renderModal($race_id, $distance_id) {
        $race = Race::find()->where(['id' => $race_id])->published()->one();
        $raceDistance = RaceDistanceRef::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id, 'type' => RaceDistanceRef::TYPE_RELAY])->one();
        $raceRelays = RaceRelay::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id])->orderBy(['position' => SORT_ASC])->all();

        $groups = ArrayHelper::index(RaceRelayRegistration::find()->where(['race_id' => $race_id, 'distance_id' => $distance_id])->all(), 'position', 'group');

        if ($race && $raceDistance) {
            return $this->renderPartial('relay_modal_content', [
                'race' => $race,
                'raceDistance' => $raceDistance,
                'raceRelays' => $raceRelays,
                'groups' => $groups,
            ]);
        }else {
            return false;
        }
    }
}
