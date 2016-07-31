<?php

use yii\db\Migration;

class m160731_170715_alter_post_table extends Migration
{
    public $tableName = '{{%post}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'type', $this->integer());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'type');
    }
}
