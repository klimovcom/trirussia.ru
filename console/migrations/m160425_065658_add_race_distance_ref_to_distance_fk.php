<?php

use yii\db\Migration;

/**
 * Class m160425_065658_add_race_distance_ref_to_distance_fk
 */
class m160425_065658_add_race_distance_ref_to_distance_fk extends Migration
{
    public $tableName = '{{%race_distance_ref}}';

    public function up()
    {
        $this->addForeignKey(
            'race_distance_ref_to_distance_fk',
            $this->tableName,
            'distance_id',
            '{{%distance}}',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('race_distance_ref_to_distance_fk', $this->tableName);
    }
}
