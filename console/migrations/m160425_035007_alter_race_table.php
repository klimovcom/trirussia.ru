<?php

use yii\db\Migration;

/**
 * Class m160425_035007_alter_race_table
 */
class m160425_035007_alter_race_table extends Migration
{
    public $tableName = '{{%race}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'special_distance', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'special_distance');
    }
}
