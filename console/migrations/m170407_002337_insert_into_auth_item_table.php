<?php

use yii\db\Migration;

class m170407_002337_insert_into_auth_item_table extends Migration
{
    public $tableName = 'auth_item';

    public function up()
    {
        $this->insert($this->tableName, [
            'name' => 'user_role',
            'type' => '1',
            'description' => 'Пользователь',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);

    }

    public function down()
    {
        return true;
    }
}
