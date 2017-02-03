<?php

use yii\db\Migration;

class m170203_121750_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для страницы промокодов',
            'description' => 'Сео: заголовок для страницы промокодов',
            'key' => 'seo_promocodes_title',
            'value' => 'TriRussia.ru - промокоды',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для страницы промокодов',
            'description' => 'Сео: описание для страницы промокодов',
            'key' => 'seo_promocodes_description',
            'value' => 'TriRussia.ru - промокоды',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для сводной страницы тренеров',
            'description' => 'Сео: заголовок для сводной страницы тренеров',
            'key' => 'seo_coach_index_title',
            'value' => 'TriRussia.ru - тренеры',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для сводной страницы тренеров',
            'description' => 'Сео: для сводной страницы тренеров',
            'key' => 'seo_coach_index_description',
            'value' => 'TriRussia.ru - тренеры',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для страницы тренера',
            'description' => 'Сео: заголовок для страницы тренера',
            'key' => 'seo_coach_view_title',
            'value' => 'TriRussia.ru - Информация о тренере: {label}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для страницы тренера',
            'description' => 'Сео: для страницы тренера',
            'key' => 'seo_coach_view_description',
            'value' => 'TriRussia.ru - Информация о тренере: {label}',
        ]);
    }

    public function down()
    {
        return true;
    }
}
