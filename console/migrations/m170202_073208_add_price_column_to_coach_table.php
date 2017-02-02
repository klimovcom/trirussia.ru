<?php

use yii\db\Migration;

/**
 * Handles adding price to table `coach`.
 */
class m170202_073208_add_price_column_to_coach_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('coach', 'price', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('coach', 'price');
    }
}
