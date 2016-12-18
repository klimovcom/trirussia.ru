<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_banner`.
 */
class m161218_114421_create_product_banner_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_banner', [
            'id' => $this->primaryKey(),
            'label' => $this->string(),
            'content' => $this->text()->notNull(),
            'type' => $this->boolean()->notNull(),
            'position' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_banner');
    }
}
