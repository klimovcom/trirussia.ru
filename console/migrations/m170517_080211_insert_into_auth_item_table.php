<?php

use yii\db\Migration;

class m170517_080211_insert_into_auth_item_table extends Migration
{
    public $tableName = 'auth_item';

    public function up()
    {
        $this->insert($this->tableName, [
            'name' => 'camp',
            'type' => '2',
            'description' => 'Соревнования - полный доступ',
            'created_at' => '1487075689',
            'updated_at' => '1487075689',
        ]);
    }

    public function down()
    {
        return true;
    }
}
