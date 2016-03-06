<?php

use yii\db\Migration;

/**
 * Class m160306_033443_create_race_table
 */
class m160306_033443_create_race_table extends Migration
{
    public $tableName = '{{%race}}';

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
            'author_id' => $this->integer()->notNull(),
            'start_date' => $this->date()->notNull(),
            'finish_date' => $this->date(),
            'start_time' => $this->string(5),
            'country' => $this->string(100)->notNull(),
            'region' => $this->string(100)->notNull(),
            'place' => $this->string(255),
            'label' => $this->string()->notNull(),
            'url' => $this->string()->unique()->notNull(),
            'price' => $this->float(10),
            'currency' => $this->string(),
            'organizer_id' => $this->integer(),
            'site' => $this->string(),
            'main_image_id' => $this->integer(),
            'promo' => $this->text()->notNull(),
            'content' => $this->text(),
            'instagram_tag' => $this->string(50),
            'facebook_event_id' => $this->string(),
            'published' => $this->boolean(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
