<?php

use yii\db\Migration;

/**
 * Class m160306_033639_create_content_page_table
 */
class m160306_033639_create_content_page_table extends Migration
{
    public $tableName = '{{%content_page}}';

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
            'content' => $this->text()->notNull(),
            'url' => $this->string()->unique()->notNull(),
            'published' => $this->boolean(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
