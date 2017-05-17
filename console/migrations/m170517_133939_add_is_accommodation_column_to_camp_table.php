<?php

use yii\db\Migration;

/**
 * Handles adding is_accommodation to table `camp`.
 */
class m170517_133939_add_is_accommodation_column_to_camp_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('camp', 'is_accommodation', $this->boolean());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('camp', 'is_accommodation');
    }
}
