<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_attr`.
 */
class m161209_115801_create_product_attr_table extends Migration
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

        $this->createTable('product_attr', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'type' => $this->boolean()->notNull(),
            'position' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_attr');
    }
}
