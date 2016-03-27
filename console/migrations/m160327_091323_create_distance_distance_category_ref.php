<?php

use yii\db\Migration;

/**
 * Class m160327_091323_create_distance_distance_category_ref
 */
class m160327_091323_create_distance_distance_category_ref extends Migration
{
    public $tableName = '{{%distance_distance_category_ref}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'distance_id' => $this->integer(),
            'distance_category_id' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
