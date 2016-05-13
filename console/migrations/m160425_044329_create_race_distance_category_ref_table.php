<?php

use yii\db\Migration;

/**
 * Class m160425_044329_create_race_distance_category_ref_table
 */
class m160425_044329_create_race_distance_category_ref_table extends Migration
{
    public $tableName = '{{%race_distance_category_ref}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'race_id' => $this->integer(),
            'distance_category_id' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
