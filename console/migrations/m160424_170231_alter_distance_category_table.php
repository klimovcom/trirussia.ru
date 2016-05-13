<?php

use yii\db\Migration;

/**
 * Class m160424_170231_alter_distance_category_table
 */
class m160424_170231_alter_distance_category_table extends Migration
{
    public $tableName = '{{%distance_category}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'sport_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'sport_id');
    }
}
