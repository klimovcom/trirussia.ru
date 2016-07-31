<?php

use yii\db\Migration;

class m160731_181143_alter_post_table extends Migration
{
    public $tableName = '{{%post}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'featured', $this->boolean());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'featured');
    }
}
