<?php

use yii\db\Migration;

/**
 * Handles dropping price from table `coach`.
 */
class m170203_105327_drop_price_column_from_coach_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('coach', 'price');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('coach', 'price', $this->integer());
    }
}
