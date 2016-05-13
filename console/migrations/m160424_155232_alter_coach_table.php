<?php

use yii\db\Migration;

/**
 * Class m160424_155232_alter_coach_table
 */
class m160424_155232_alter_coach_table extends Migration
{
    public $tableName = '{{%coach}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'promo', $this->text());
        $this->addColumn($this->tableName, 'content', $this->text());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'promo');
        $this->dropColumn($this->tableName, 'content');
    }
}
