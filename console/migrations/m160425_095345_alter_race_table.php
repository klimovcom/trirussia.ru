<?php

use yii\db\Migration;

/**
 * Class m160425_095345_alter_race_table
 */
class m160425_095345_alter_race_table extends Migration
{
    public $tableName = '{{%race}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'featured', $this->boolean());
        $this->addColumn($this->tableName, 'hide_image', $this->boolean());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'featured');
        $this->dropColumn($this->tableName, 'hide_image');
    }
}
