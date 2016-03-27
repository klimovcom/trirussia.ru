<?php

use yii\db\Migration;

class m160327_091352_add_distance_distance_category_ref_to_distance_category_fk extends Migration
{
    public $tableName = '{{%distance_distance_category_ref}}';

    public function up()
    {
        $this->addForeignKey(
            'distance_distance_category_ref_to_distance_category_fk',
            $this->tableName,
            'distance_category_id',
            '{{%distance_category}}',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('distance_distance_category_ref_to_distance_category_fk', $this->tableName);
    }
}
