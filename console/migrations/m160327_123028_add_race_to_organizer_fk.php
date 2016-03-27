<?php

use yii\db\Migration;

/**
 * Class m160327_123028_add_race_to_organizer_fk
 */
class m160327_123028_add_race_to_organizer_fk extends Migration
{
    public $tableName = '{{%race}}';

    public function up()
    {
        $this->addForeignKey('race_to_organizer_fk', $this->tableName, 'organizer_id', '{{%organizer}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('race_to_organizer_fk', $this->tableName);
    }
}
