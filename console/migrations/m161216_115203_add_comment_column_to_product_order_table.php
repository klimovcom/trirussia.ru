<?php

use yii\db\Migration;

/**
 * Handles adding comment to table `product_order`.
 */
class m161216_115203_add_comment_column_to_product_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product_order', 'comment', $this->text());
        $this->addColumn('product_order', 'status', $this->boolean()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product_order', 'comment');
        $this->dropColumn('product_order', 'status');
    }
}
