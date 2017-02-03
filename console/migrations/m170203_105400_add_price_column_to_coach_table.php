<?php

use yii\db\Migration;

/**
 * Handles adding price to table `coach`.
 */
class m170203_105400_add_price_column_to_coach_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('coach', 'price', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('coach', 'price');
    }
}
