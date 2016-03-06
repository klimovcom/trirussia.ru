<?php

use yii\db\Migration;

/**
 * Class m160306_033538_create_distance_table
 */
class m160306_033538_create_distance_table extends Migration
{
    public $tableName = '{{%distance}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'sport_id' =>$this->integer(),
            'label' => $this->string(),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
