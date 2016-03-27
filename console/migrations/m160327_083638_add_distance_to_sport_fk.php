<?php

use yii\db\Migration;

/**
 * Class m160327_083638_add_distance_to_sport_fk
 */
class m160327_083638_add_distance_to_sport_fk extends Migration
{
    public $tableName = '{{%distance}}';

    public function up()
    {
        $this->addForeignKey('distance_to_sport_fk', $this->tableName, 'sport_id', '{{%sport}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('distance_to_sport_fk', $this->tableName);
    }
}
