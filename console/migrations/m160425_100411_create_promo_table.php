<?php

use yii\db\Migration;

/**
 * Class m160425_100411_create_promo_table
 */
class m160425_100411_create_promo_table extends Migration
{
    public $tableName = '{{%promo}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'label' => $this->string(),
            'content' => $this->text(),
            'position' => $this->integer(),
            'published' => $this->boolean()->defaultValue(1),
            'created' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
