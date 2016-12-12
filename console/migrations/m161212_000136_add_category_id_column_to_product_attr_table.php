<?php

use yii\db\Migration;

/**
 * Handles adding category_id to table `product_attr`.
 * Has foreign keys to the tables:
 *
 * - `product_category`
 */
class m161212_000136_add_category_id_column_to_product_attr_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product_attr', 'category_id', $this->integer()->notNull());

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product_attr-category_id',
            'product_attr',
            'category_id'
        );

        // add foreign key for table `product_category`
        $this->addForeignKey(
            'fk-product_attr-category_id',
            'product_attr',
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
            'fk-product_attr-category_id',
            'product_attr'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-product_attr-category_id',
            'product_attr'
        );

        $this->dropColumn('product_attr', 'category_id');
    }
}
