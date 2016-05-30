<?php

use yii\db\Migration;

/**
 * Handles the creation for table `will_go_table`.
 */
class m160530_165715_create_will_go_table extends Migration
{
    public $tableName = '{{%will_go}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' =>  $this->primaryKey(),
            'user_id' =>$this->integer(),
            'race_id' =>$this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
