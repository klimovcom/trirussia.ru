<?php

use yii\db\Migration;

/**
 * Class m160424_155242_create_coach_sport_ref_table
 */
class m160424_155242_create_coach_sport_ref_table extends Migration
{
    public $tableName = '{{%coach_sport_ref}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'coach_id' => $this->integer(),
            'sport_id' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('coach_sport_ref_table');
    }
}
