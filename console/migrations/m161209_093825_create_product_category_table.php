<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category`.
 */
class m161209_093825_create_product_category_table extends Migration
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

        $this->createTable('product_category', [
            'id' => $this->primaryKey(),
            'created' => $this->dateTime()->notNull(),
            'label' => $this->string()->notNull(),
            'promo' => $this->text(),
            'content' => $this->text(),
            'image_id' => $this->integer(),
            'published' => $this->boolean(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_category');
    }
}
