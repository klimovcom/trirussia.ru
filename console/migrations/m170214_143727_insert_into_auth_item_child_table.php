<?php

use yii\db\Migration;

class m170214_143727_insert_into_auth_item_child_table extends Migration
{
    public $tableName = 'auth_item_child';

    public function up()
    {
        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'user',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'permit',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'race',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'sport',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'distance',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'organizer',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'coach',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'page',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'post',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'product',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'promo',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'configuration',
        ]);

        $this->insert($this->tableName, [
            'parent' => 'admin',
            'child' => 'promocode',
        ]);
    }

    public function down()
    {
        return true;
    }
}
