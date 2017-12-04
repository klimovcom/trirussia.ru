<?php
namespace api\modules\race\components;

use api\modules\race\dto\RaceDto;
use api\modules\race\models\Race;
use yii\base\Component;

class RaceManager extends Component
{
    public function index()
    {
        $races = Race::find()->future()->published()->all();

        return array_map(function($race) {
            /** Race $race */
            return $this->composeDto($race);
        }, $races);
    }

    private function composeDto(Race $race)
    {
        $dto = new RaceDto();
        $dto->id = $race->id;
        $dto->start_date = $race->start_date;
        $dto->place = implode(', ', [$race->region, $race->place]);
        $dto->promo = $race->promo;
        $dto->sport = $race->sport->label;
        $dto->organizer = $race->organizer->label;
        return $dto;
    }
}