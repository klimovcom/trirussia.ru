<?php

use yii\db\Migration;

class m170517_080238_insert_into_auth_item_child_table extends Migration
{
    public $tableName = 'auth_item_child';

    public function up()
    {
        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'camp',
        ]);
    }

    public function down()
    {
        return true;
    }
}
