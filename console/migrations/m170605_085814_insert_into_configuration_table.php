<?php

use yii\db\Migration;

class m170605_085814_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок страницы продажи слотов',
            'description' => 'Сео: заголовок страницы продажи слотов',
            'key' => 'seo_race_sell_slot_title',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: описание страницы продажи слотов',
            'description' => 'Сео: описание страницы продажи слотов',
            'key' => 'seo_race_sell_slot_description',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для страницы продажи слотов',
            'description' => 'Сео: ключевые слова для страницы продажи слотов',
            'key' => 'seo_race_sell_slot_keywords',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для  сводной страницы продажи слотов',
            'description' => 'Сео: изображение для сводной страницы продажи слотов',
            'key' => 'seo_race_sell_slot_og_image',
            'value' => '',
        ]);
    }

    public function down()
    {
        return true;
    }
}
