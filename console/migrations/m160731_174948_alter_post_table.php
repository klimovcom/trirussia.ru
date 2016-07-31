<?php

use yii\db\Migration;

class m160731_174948_alter_post_table extends Migration
{
    public $tableName = '{{%post}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'tags', $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'tags');
    }
    
}
