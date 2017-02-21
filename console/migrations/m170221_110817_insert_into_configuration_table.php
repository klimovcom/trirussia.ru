<?php

use yii\db\Migration;

class m170221_110817_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок страницы добавления тренера',
            'description' => 'Сео: заголовок страницы добавления тренера',
            'key' => 'seo_coach_create_title',
            'value' => 'Добавьте тренера на TriRussia.ru',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для страницы добавления тренера',
            'description' => 'Сео: описание страницы добавления тренера',
            'key' => 'seo_coach_create_description',
            'value' => 'Добавьте тренера на TriRussia.ru',
        ]);
    }

    public function down()
    {
        return true;
    }
}
