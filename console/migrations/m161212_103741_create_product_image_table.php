<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_image`.
 * Has foreign keys to the tables:
 *
 * - `product`
 */
class m161212_103741_create_product_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_image', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_image-product_id',
            'product_image',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_image-product_id',
            'product_image',
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
            'fk-product_image-product_id',
            'product_image'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_image-product_id',
            'product_image'
        );

        $this->dropTable('product_image');
    }
}
