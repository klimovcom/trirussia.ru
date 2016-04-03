<?php

use yii\db\Migration;
use \yii\db\pgsql\Schema;

class m160403_095238_create_seo_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%seo}}', [
            'id' => Schema::TYPE_PK,
            'model_name' => Schema::TYPE_STRING . ' NOT NULL',
            'model_id' => Schema::TYPE_INTEGER. ' NOT NULL',
            'title' => Schema::TYPE_STRING,
            'keywords' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%seo}}');
    }
}
