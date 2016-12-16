<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_order_item`.
 * Has foreign keys to the tables:
 *
 * - `product`
 */
class m161213_144147_create_product_order_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('product_order_item', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'info' => $this->text(),
        ], $tableOptions);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_order_item-product_id',
            'product_order_item',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_order_item-product_id',
            'product_order_item',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-product_order_item-product_id',
            'product_order_item'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_order_item-product_id',
            'product_order_item'
        );

        $this->dropTable('product_order_item');
    }
}
