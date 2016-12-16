<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_order_product_order_item`.
 * Has foreign keys to the tables:
 *
 * - `product_order`
 * - `product_order_item`
 */
class m161214_140916_create_junction_table_for_product_order_and_product_order_item_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_order_product_order_item', [
            'product_order_id' => $this->integer(),
            'product_order_item_id' => $this->integer(),
            'quantity' => $this->integer()->notNull(),
            'PRIMARY KEY(product_order_id, product_order_item_id)',
        ]);

        // creates index for column `product_order_id`
        $this->createIndex(
            'idx-product_order_product_order_item-product_order_id',
            'product_order_product_order_item',
            'product_order_id'
        );

        // add foreign key for table `product_order`
        $this->addForeignKey(
            'fk-product_order_product_order_item-product_order_id',
            'product_order_product_order_item',
            'product_order_id',
            'product_order',
            'id',
            'CASCADE'
        );

        // creates index for column `product_order_item_id`
        $this->createIndex(
            'idx-product_order_product_order_item-product_order_item_id',
            'product_order_product_order_item',
            'product_order_item_id'
        );

        // add foreign key for table `product_order_item`
        $this->addForeignKey(
            'fk-product_order_product_order_item-product_order_item_id',
            'product_order_product_order_item',
            'product_order_item_id',
            'product_order_item',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `product_order`
        $this->dropForeignKey(
            'fk-product_order_product_order_item-product_order_id',
            'product_order_product_order_item'
        );

        // drops index for column `product_order_id`
        $this->dropIndex(
            'idx-product_order_product_order_item-product_order_id',
            'product_order_product_order_item'
        );

        // drops foreign key for table `product_order_item`
        $this->dropForeignKey(
            'fk-product_order_product_order_item-product_order_item_id',
            'product_order_product_order_item'
        );

        // drops index for column `product_order_item_id`
        $this->dropIndex(
            'idx-product_order_product_order_item-product_order_item_id',
            'product_order_product_order_item'
        );

        $this->dropTable('product_order_product_order_item');
    }
}
