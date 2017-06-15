<?php

use yii\db\Migration;

class m170615_172933_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок сводной страницы тренировок',
            'description' => 'Сео: заголовок сводной страницы тренировок',
            'key' => 'seo_training_index_title',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: описание сводной страниц тренировокв',
            'description' => 'Сео: описание сводной страницы тренировок',
            'key' => 'seo_training_index_description',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для сводной страницы тренировок',
            'description' => 'Сео: ключевые слова для сводной страницы тренировок',
            'key' => 'seo_training_index_keywords',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для сводной страницы тренировок',
            'description' => 'Сео: изображение для сводной страницы тренировок',
            'key' => 'seo_training_index_og_image',
            'value' => '',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок страницы добавления тренировок',
            'description' => 'Сео: заголовок страницы добавления тренировок',
            'key' => 'seo_training_create_title',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: описание страницы добавления тренировок',
            'description' => 'Сео: описание страницы добавления тренировок',
            'key' => 'seo_training_create_description',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для страницы добавления тренировок',
            'description' => 'Сео: ключевые слова для страницы добавления тренировок',
            'key' => 'seo_training_create_keywords',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для страницы добавления тренировок',
            'description' => 'Сео: изображение для страницы добавления тренировок',
            'key' => 'seo_training_create_og_image',
            'value' => '',
        ]);
    }

    public function down()
    {
        return true;
    }
}
