<?php

use yii\db\Migration;

class m160516_175341_alter_sport_table extends Migration
{
    public $tableName = '{{%sport}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'is_on_main', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'is_on_main');
    }
}
