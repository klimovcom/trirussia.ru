<?php

use yii\db\Migration;

class m170214_142353_insert_into_auth_item_table extends Migration
{
    public $tableName = 'auth_item';

    public function up()
    {
        $this->insert($this->tableName, [
            'name' => 'admin',
            'type' => '1',
            'description' => 'Админ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'content',
            'type' => '1',
            'description' => 'Контент',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'user',
            'type' => '2',
            'description' => 'Пользователи - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'permit',
            'type' => '2',
            'description' => 'Роли - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'race',
            'type' => '2',
            'description' => 'Соревнования - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'sport',
            'type' => '2',
            'description' => 'Виды спорта - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'distance',
            'type' => '2',
            'description' => 'Дистанции - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'organizer',
            'type' => '2',
            'description' => 'Организаторы - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'coach',
            'type' => '2',
            'description' => 'Тренеры - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'page',
            'type' => '2',
            'description' => 'Страницы - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'post',
            'type' => '2',
            'description' => 'Журнал - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'product',
            'type' => '2',
            'description' => 'Магазин - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'promo',
            'type' => '2',
            'description' => 'Промо-блоки - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'configuration',
            'type' => '2',
            'description' => 'Конфигурация - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

        $this->insert($this->tableName, [
            'name' => 'promocode',
            'type' => '2',
            'description' => 'Промокоды - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);
    }

    public function down()
    {
        return true;
    }
}
