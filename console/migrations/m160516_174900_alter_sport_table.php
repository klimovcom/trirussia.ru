<?php

use yii\db\Migration;

/**
 * Class m160516_174900_alter_sport_table
 */
class m160516_174900_alter_sport_table extends Migration
{
    public $tableName = '{{%sport}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'url', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'url');
    }
}
