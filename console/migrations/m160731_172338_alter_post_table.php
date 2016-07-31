<?php

use yii\db\Migration;

class m160731_172338_alter_post_table extends Migration
{
    public $tableName = '{{%post}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'popularity', $this->integer());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'popularity');
    }
}
