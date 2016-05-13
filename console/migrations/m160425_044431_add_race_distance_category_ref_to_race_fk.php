<?php

use yii\db\Migration;

/**
 * Class m160425_044431_add_race_distance_category_ref_to_race_fk
 */
class m160425_044431_add_race_distance_category_ref_to_race_fk extends Migration
{
    public $tableName = '{{%race_distance_category_ref}}';

    public function up()
    {
        $this->addForeignKey(
            'race_distance_category_ref_to_race_fk',
            $this->tableName,
            'race_id',
            '{{%race}}',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('race_distance_category_ref_to_race_fk', $this->tableName);
    }
}
