<?php

use yii\db\Migration;

/**
 * Class m160327_091024_add_race_to_sport_fk
 */
class m160327_091024_add_race_to_sport_fk extends Migration
{
    public  $tableName = '{{%race}}';

    public function up()
    {
        $this->addForeignKey('race_to_sport_fk', $this->tableName, 'sport_id', '{{%sport}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('race_to_sport_fk', $this->tableName);
    }
}
