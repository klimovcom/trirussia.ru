<?php

use yii\db\Migration;

class m160605_024450_alter_race_table extends Migration
{
    public $tableName = '{{%race}}';


    public function up()
    {
        $this->dropColumn($this->tableName, 'hide_image');
        $this->dropColumn($this->tableName, 'featured');
        $this->addColumn($this->tableName, 'display_type', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->addColumn($this->tableName, 'hide_image', $this->boolean());
        $this->addColumn($this->tableName, 'featured', $this->boolean());
        $this->dropColumn($this->tableName, 'display_type');
    }
}
