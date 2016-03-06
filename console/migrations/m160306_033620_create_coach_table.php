<?php

use yii\db\Migration;

/**
 * Class m160306_033620_create_coach_table
 */
class m160306_033620_create_coach_table extends Migration
{
    public $tableName = '{{%coach}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'created' =>$this->dateTime()->notNull(),
            'label' => $this->string()->notNull(),
            'image_id' => $this->integer()->notNull(),
            'country' => $this->string()->notNull(),
            'site' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'fb_link' => $this->string(),
            'vk_link' => $this->string(),
            'ig_link' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
