<?php

use yii\db\Migration;

/**
 * Handles adding price to table `product`.
 */
class m161209_100134_add_price_column_to_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'price', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'price');
    }
}
