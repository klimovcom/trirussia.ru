<?php

use yii\db\Migration;

class m170614_153734_insert_info_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок сводной страницы тренировочных планов',
            'description' => 'Сео: заголовок сводной страницы тренировочных планов',
            'key' => 'seo_training_plan_index_title',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: описание сводной страницы тренировочных планов',
            'description' => 'Сео: описание сводной страницы тренировочных планов',
            'key' => 'seo_training_plan_index_description',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для сводной страницы тренировочных планов',
            'description' => 'Сео: ключевые слова для сводной страницы тренировочных планов',
            'key' => 'seo_training_plan_index_keywords',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для сводной страницы тренировочных планов',
            'description' => 'Сео: изображение для сводной страницы тренировочных планов',
            'key' => 'seo_training_plan_index_og_image',
            'value' => '',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок страницы тренировочного плана',
            'description' => 'Сео: заголовок страницы тренировочного планa',
            'key' => 'seo_training_plan_view_title',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: описание страницы тренировочного планa',
            'description' => 'Сео: описание страницы тренировочного планa',
            'key' => 'seo_training_plan_view_description',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для страницы тренировочного планa',
            'description' => 'Сео: ключевые слова для страницы тренировочного планa',
            'key' => 'seo_training_plan_view_keywords',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для страницы тренировочного планa',
            'description' => 'Сео: изображение для страницы тренировочного планa',
            'key' => 'seo_training_plan_view_og_image',
            'value' => '',
        ]);
    }

    public function down()
    {
        return true;
    }
}
