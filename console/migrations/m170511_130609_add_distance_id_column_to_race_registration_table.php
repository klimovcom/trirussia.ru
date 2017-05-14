<?php

use yii\db\Migration;

/**
 * Handles adding distance_id to table `race_registration`.
 */
class m170511_130609_add_distance_id_column_to_race_registration_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('race_registration', 'distance_id', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('race_registration', 'distance_id');
    }
}
