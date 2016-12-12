<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_product_attr_value`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `product_attr`
 * - `product_attr_value`
 */
class m161209_121317_create_product_product_attr_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('product_product_attr_value', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'attr_id' => $this->integer()->notNull(),
            'value_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_product_attr_value-product_id',
            'product_product_attr_value',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_product_attr_value-product_id',
            'product_product_attr_value',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `attr_id`
        $this->createIndex(
            'idx-product_product_attr_value-attr_id',
            'product_product_attr_value',
            'attr_id'
        );

        // add foreign key for table `product_attr`
        $this->addForeignKey(
            'fk-product_product_attr_value-attr_id',
            'product_product_attr_value',
            'attr_id',
            'product_attr',
            'id',
            'CASCADE'
        );

        // creates index for column `value_id`
        $this->createIndex(
            'idx-product_product_attr_value-value_id',
            'product_product_attr_value',
            'value_id'
        );

        // add foreign key for table `product_attr_value`
        $this->addForeignKey(
            'fk-product_product_attr_value-value_id',
            'product_product_attr_value',
            'value_id',
            'product_attr_value',
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
            'fk-product_product_attr_value-product_id',
            'product_product_attr_value'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_product_attr_value-product_id',
            'product_product_attr_value'
        );

        // drops foreign key for table `product_attr`
        $this->dropForeignKey(
            'fk-product_product_attr_value-attr_id',
            'product_product_attr_value'
        );

        // drops index for column `attr_id`
        $this->dropIndex(
            'idx-product_product_attr_value-attr_id',
            'product_product_attr_value'
        );

        // drops foreign key for table `product_attr_value`
        $this->dropForeignKey(
            'fk-product_product_attr_value-value_id',
            'product_product_attr_value'
        );

        // drops index for column `value_id`
        $this->dropIndex(
            'idx-product_product_attr_value-value_id',
            'product_product_attr_value'
        );

        $this->dropTable('product_product_attr_value');
    }
}
