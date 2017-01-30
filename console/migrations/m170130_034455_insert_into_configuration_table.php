<?php

use yii\db\Migration;

class m170130_034455_insert_into_configuration_table extends Migration
{

    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок сводной магазина',
            'description' => 'Сео: заголовок сводной магазина title',
            'key' => 'seo_shop_page_title',
            'value' => 'Магазин TriRussia.ru',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для сводной магазина',
            'description' => 'Сео: описание для сводной магазина',
            'key' => 'seo_shop_page_description',
            'value' => 'Магазин TriRussia.ru',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для товара',
            'description' => 'Сео: промо в теге description',
            'key' => 'seo_shop_product_page_description',
            'value' => '{productPromo}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для товара',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_shop_product_page_title',
            'value' => '{productTitle}',
        ]);
    }

    public function down()
    {
        return true;
    }

}
