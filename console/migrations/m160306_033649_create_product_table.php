<?php

use yii\db\Migration;

/**
 * Class m160306_033649_create_product_table
 */
class m160306_033649_create_product_table extends Migration
{
    public $tableName = '{{%product}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'created' => $this->dateTime()->notNull(),
            'label' => $this->string()->notNull(),
            'url' => $this->string()->unique()->notNull(),
            'promo' => $this->text(),
            'content' => $this->text(),
            'image_id' => $this->integer(),
            'published' => $this->boolean(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
