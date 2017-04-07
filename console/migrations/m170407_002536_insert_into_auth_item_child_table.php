<?php

use yii\db\Migration;

class m170407_002536_insert_into_auth_item_child_table extends Migration
{
    public $tableName = 'auth_item_child';

    public function up()
    {
        $this->insert($this->tableName, [
            'parent' => 'user_role',
            'child' => 'coach',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'user_role',
            'child' => 'race',
        ]);
    }

    public function down()
    {
        return true;
    }
}
