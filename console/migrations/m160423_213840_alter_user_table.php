<?php

use yii\db\Migration;

/**
 * Class m160423_213840_alter_user_table
 */
class m160423_213840_alter_user_table extends Migration
{
    public $tableName = '{{%user}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'fb_id', $this->string());
        $this->addColumn($this->tableName, 'first_name', $this->string());
        $this->addColumn($this->tableName, 'last_name', $this->string());
        $this->addColumn($this->tableName, 'sex', $this->string());
        $this->addColumn($this->tableName, 'locale', $this->string());
        $this->addColumn($this->tableName, 'timezone', $this->string());
        $this->addColumn($this->tableName, 'age', $this->string());
        $this->addColumn($this->tableName, 'birthday', $this->date());
        $this->addColumn($this->tableName, 'place', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'fb_id');
        $this->dropColumn($this->tableName, 'first_name');
        $this->dropColumn($this->tableName, 'last_name');
        $this->dropColumn($this->tableName, 'sex');
        $this->dropColumn($this->tableName, 'locale');
        $this->dropColumn($this->tableName, 'timezone');
        $this->dropColumn($this->tableName, 'age');
        $this->dropColumn($this->tableName, 'birthday');
        $this->dropColumn($this->tableName, 'place');

    }
}
