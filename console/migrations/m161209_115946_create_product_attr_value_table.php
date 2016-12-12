<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_attr_value`.
 * Has foreign keys to the tables:
 *
 * - `product_attr`
 */
class m161209_115946_create_product_attr_value_table extends Migration
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

        $this->createTable('product_attr_value', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'attr_id' => $this->integer()->notNull(),
            'position' => $this->integer(),
        ], $tableOptions);

        // creates index for column `attr_id`
        $this->createIndex(
            'idx-product_attr_value-attr_id',
            'product_attr_value',
            'attr_id'
        );

        // add foreign key for table `product_attr`
        $this->addForeignKey(
            'fk-product_attr_value-attr_id',
            'product_attr_value',
            'attr_id',
            'product_attr',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `product_attr`
        $this->dropForeignKey(
            'fk-product_attr_value-attr_id',
            'product_attr_value'
        );

        // drops index for column `attr_id`
        $this->dropIndex(
            'idx-product_attr_value-attr_id',
            'product_attr_value'
        );

        $this->dropTable('product_attr_value');
    }
}
