<?php

use yii\db\Migration;

class m170604_151600_insert_info_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок сводной страницы кэмпов',
            'description' => 'Сео: заголовок сводной страницы кэмпов',
            'key' => 'seo_camp_index_title',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: описание сводной страницы кэмпов',
            'description' => 'Сео: описание сводной страницы кэмпов',
            'key' => 'seo_camp_index_description',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для сводной страницы кэмпов',
            'description' => 'Сео: ключевые слова для сводной страницы кэмпов',
            'key' => 'seo_camp_index_keywords',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для  сводной страницы кэмпов',
            'description' => 'Сео: изображение для сводной страницы кэмпов',
            'key' => 'seo_camp_index_og_image',
            'value' => '',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок страницы кэмпа',
            'description' => 'Сео: заголовок страницы кэмпа',
            'key' => 'seo_camp_view_title',
            'value' => 'Кэмп {label}',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: описание страницы кэмпа',
            'description' => 'Сео: описание страницы кэмпа',
            'key' => 'seo_camp_view_description',
            'value' => 'Информация о кэмпе {label} на Trirussia.ru',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для страницы кэмпа',
            'description' => 'Сео: ключевые слова для страницы кэмпа',
            'key' => 'seo_camp_view_keywords',
            'value' => '',
        ]);
        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для страницы кэмпа',
            'description' => 'Сео: изображение для страницы кэмпа',
            'key' => 'seo_camp_view_og_image',
            'value' => '',
        ]);
    }

    public function down()
    {
        return true;
    }
}
