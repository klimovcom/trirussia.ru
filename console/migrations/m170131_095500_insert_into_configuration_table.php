<?php

use yii\db\Migration;

class m170131_095500_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для поиска статей по тегам',
            'description' => 'Сео: заголовок для поиска статей по тегам',
            'key' => 'seo_magazine_search_tag_page_title',
            'value' => 'TriRussia.ru - поиск по тегу: {tag}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для поиска статей по тегам',
            'description' => 'Сео: описание для поиска статей по тегам',
            'key' => 'seo_magazine_search_tag_page_description',
            'value' => 'TriRussia.ru - поиск по тегу: {tag}',
        ]);
    }

    public function down()
    {
        return true;
    }

}
