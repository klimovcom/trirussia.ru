<?php

use yii\db\Migration;

/**
 * Class m160327_091345_add_distance_distance_category_ref_to_distance_fk
 */
class m160327_091345_add_distance_distance_category_ref_to_distance_fk extends Migration
{
    public $tableName = '{{%distance_distance_category_ref}}';

    public function up()
    {
        $this->addForeignKey(
            'distance_distance_category_ref_to_distance_fk',
            $this->tableName,
            'distance_id',
            '{{%distance}}',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('distance_distance_category_ref_to_distance_fk', $this->tableName);
    }
}
