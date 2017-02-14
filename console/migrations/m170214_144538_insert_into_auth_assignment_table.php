<?php

use yii\db\Migration;

class m170214_144538_insert_into_auth_assignment_table extends Migration
{
    public $tableName = 'auth_assignment';

    public function up()
    {
        $this->insert($this->tableName, [
            'item_name' => 'admin',
            'user_id' => '1',
            'created_at' => '1487075689',
        ]);
    }

    public function down()
    {
        return true;
    }
}
