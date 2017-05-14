<?php

use yii\db\Migration;

/**
 * Handles adding distance_type to table `race_registration`.
 */
class m170514_003919_add_distance_type_column_to_race_registration_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('race_registration', 'distance_type', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('race_registration', 'distance_type');
    }
}
