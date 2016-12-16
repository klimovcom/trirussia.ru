<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_order`.
 */
class m161214_140139_create_product_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_order', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'date' => $this->string()->notNull(),
            'time' => $this->boolean()->notNull(),
            'cost' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_order');
    }
}
