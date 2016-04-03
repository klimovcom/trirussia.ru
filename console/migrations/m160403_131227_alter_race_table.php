<?php

use yii\db\Migration;

class m160403_131227_alter_race_table extends Migration
{
    public $tableName  = '{{%race}}';
    public function up()
    {
        $this->addColumn($this->tableName, 'coord_lon', $this->float());
        $this->addColumn($this->tableName, 'coord_lat', $this->float());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'coord_lon');
        $this->dropColumn($this->tableName, 'coord_lat');
    }
}
