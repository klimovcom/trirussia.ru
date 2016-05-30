<?php

use yii\db\Migration;

class m160526_171517_alter_race_rable extends Migration
{
    public $tableName = '{{%race}}';
    public function up()
    {
        $this->addColumn($this->tableName, 'popularity', $this->integer());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'popularity');
    }
}
