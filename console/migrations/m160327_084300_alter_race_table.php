<?php

use yii\db\Migration;

/**
 * Class m160327_084300_alter_race_table
 */
class m160327_084300_alter_race_table extends Migration
{
    public $tableName = '{{%race}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'sport_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'sport_id');
    }
}
