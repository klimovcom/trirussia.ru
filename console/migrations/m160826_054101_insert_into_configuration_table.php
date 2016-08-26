<?php

use yii\db\Migration;

class m160826_054101_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: сокр. ключевые слова триатлона',
            'description' => 'Сео: сокр. выводятся в любом теге вместо ключа',
            'key' => '[triathlonKeywords]',
            'value' => 'Ironman, Half-Ironman, Ironman 70.3, олимпийская дистанция, 5150, спринт-триатлон, суперспринт, Titan, Ironstar, Grom, железный триатлон',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: сокр. ключевые слова бега',
            'description' => 'Сео: сокр. выводятся в любом теге вместо ключа',
            'key' => '[runKeywords]',
            'value' => 'марафон, полумарафон, 42 км, 21 км, 10 км, 5 км, первый забег, Московский марафон, Russia Running, Осенний гром, Весенний гром',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: сокр. ключевые слова плаванья',
            'description' => 'Сео: сокр. выводятся в любом теге вместо ключа',
            'key' => '[swimKeywords]',
            'value' => 'морская миля, заплыв, плавательный марафон, Кубок чемпионов по плаванию',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: сокр. ключевые слова велоспорта',
            'description' => 'Сео: сокр. выводятся в любом теге вместо ключа',
            'key' => '[bikeKeywords]',
            'value' => 'многодневные гонки, велогонка, гонка в Крылатском',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: сокр. ключевые слова лыж',
            'description' => 'Сео: сокр. выводятся в любом теге вместо ключа',
            'key' => '[skiKeywords]',
            'value' => 'лыжный марафон, 30 км, 15 км, классика',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: сокр. ключевые слова дуатлона',
            'description' => 'Сео: сокр. выводятся в любом теге вместо ключа',
            'key' => '[duathlonKeywords]',
            'value' => '',
        ]);


    }

    public function down()
    {
        return true;
    }
}
