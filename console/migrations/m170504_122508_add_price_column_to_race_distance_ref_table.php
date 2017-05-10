<?php

use yii\db\Migration;

/**
 * Handles adding price to table `race_distance_ref`.
 */
class m170504_122508_add_price_column_to_race_distance_ref_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('race_distance_ref', 'price', $this->integer());
        $this->addColumn('race_distance_ref', 'type', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('race_distance_ref', 'price');
        $this->dropColumn('race_distance_ref', 'type');
    }
}
