<?php

use yii\db\Migration;

/**
 * Class m160306_033556_create_organizer_table
 */
class m160306_033556_create_organizer_table extends Migration
{
    public $tableName = '{{%organizer}}';

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
            'country' => $this->string()->notNull(),
            'site' => $this->string()->notNull(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'image_id' => $this->integer()->notNull(),
            'promo' => $this->text()->notNull(),
            'content' => $this->text(),
            'published' => $this->boolean(),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
