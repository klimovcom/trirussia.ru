<?php

use yii\db\Migration;

/**
 * Handles adding category_id to table `product`.
 * Has foreign keys to the tables:
 *
 * - `product_category`
 */
class m161209_095917_add_category_id_column_to_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'category_id', $this->integer()->notNull());

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );

        // add foreign key for table `product_category`
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'product_category',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `product_category`
        $this->dropForeignKey(
            'fk-product-category_id',
            'product'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-product-category_id',
            'product'
        );

        $this->dropColumn('product', 'category_id');
    }
}
