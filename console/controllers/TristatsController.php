<?php
namespace console\controllers;

use common\components\Tristats;
use common\models\TristatsRaces;
use common\models\TristatsWinners;
use console\models\Race;
use yii\console\Controller;
use Yii;
use yii\helpers\ArrayHelper;


class TristatsController extends Controller
{
    public function actionCheckNewRaces()
    {
        set_time_limit(0);
        $tristats = new Tristats();
        $years = range(2016, (int) date('Y'));
        $added = [];
        $finded = [];

        foreach ($years as $year) {
            $races = $tristats->getRacesByYear($year);

            foreach ($races as $race) {
                $trRace = TristatsRaces::find()->where(['race_id' => $race->RaceId])->one();
                if (!$trRace) {
                    $trRace = new TristatsRaces();
                    $trRace->race_id = $race->RaceId;
                    $trRace->name = $race->RaceName;
                    $trRace->year = $year;
                    $trRace->race_url = $race->RaceUrl;
                    $trRace->racer_count = $race->RacerCount;
                    $trRace->date = date("Y-m-d", strtotime($race->Date));
                    $trRace->place = $race->Place;
                    $trRace->min_swim = $race->MinSwim;
                    $trRace->min_bike = $race->MinBike;
                    $trRace->min_run = $race->MinRun;
                    $trRace->min_finish = $race->MinFinish;
                    if ($trRace->save()) {
                        $added[] = ['name' => $trRace->name];
                        if ($findedRace = $this->findRace($trRace)) {
                            $finded[] = ['tr_race_id' => $trRace->id, 'tr_race' => $trRace->name, 'race_id' => $findedRace->id, 'race' => $findedRace->label];
                        }

                        $divisions = $tristats->getRace($trRace->race_url);
                        $divisionsUrls = ArrayHelper::getColumn(ArrayHelper::getValue($divisions, 'Divisions'), 'DivisionUrl');

                        foreach($divisionsUrls as $url) {
                            $division = $tristats->getDivision($url);
                            if ($division) {
                                $racers = ArrayHelper::index(ArrayHelper::getValue($division, 'Results'), null, 'FinishDivisionRank');

                                for ($i=1; $i<4; $i++) {
                                    $racer = new TristatsWinners();
                                    $racer->name = ArrayHelper::getValue($racers, $i.'.0.Racer');
                                    $racer->country = ArrayHelper::getValue($racers, $i.'.0.Country');
                                    $racer->division = ArrayHelper::getValue($racers, $i.'.0.Division');
                                    $racer->division_rank = ArrayHelper::getValue($racers, $i.'.0.FinishDivisionRank');
                                    $racer->swim = ArrayHelper::getValue($racers, $i.'.0.Swim');
                                    $racer->run = ArrayHelper::getValue($racers, $i.'.0.Run');
                                    $racer->bike = ArrayHelper::getValue($racers, $i.'.0.Bike');
                                    $racer->finish = ArrayHelper::getValue($racers, $i.'.0.Finish');
                                    $racer->tristats_race_id = $trRace->id;
                                    $racer->save();
                                }
                            }

                        }
                    }


                }
            }
        }
        $this->sendMessage($added, $finded);
    }

    public function findRace($trRace) {
        $races = Race::find()->where(['start_date' => $trRace->date])->all();
        foreach ($races as $race) {
            if ($race->place && (strpos($trRace->place, $race->place) !== false)) {
                return $race;
            }
            if ($race->place_en && (strpos($trRace->place, $race->place_en) !== false)) {
                return $race;
            }
        }
        return false;
    }

    public function sendMessage($added, $finded) {
        Yii::$app->mailer->compose(['text' => 'tristats-race-check'], [
            'model' => $this,
            'added' => $added,
            'finded' => $finded,
        ])
            ->setFrom('no-reply@trirussia.ru')
            ->setTo(Yii::$app->params['supportEmail'])
            ->setSubject('Проверка новых гонок на Tristats')
            ->send();
    }
}