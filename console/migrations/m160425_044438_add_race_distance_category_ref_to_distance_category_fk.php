<?php

use yii\db\Migration;

/**
 * Class m160425_044438_add_race_distance_category_ref_to_distance_category_fk
 */
class m160425_044438_add_race_distance_category_ref_to_distance_category_fk extends Migration
{
    public $tableName = '{{%race_distance_category_ref}}';

    public function up()
    {
        $this->addForeignKey(
            'race_distance_category_ref_to_distance_category_fk',
            $this->tableName,
            'distance_category_id',
            '{{%distance_category}}',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('race_distance_category_ref_to_distance_category_fk', $this->tableName);
    }
}
