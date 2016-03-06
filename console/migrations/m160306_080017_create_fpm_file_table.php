<?php

use yii\db\Migration;
use \yii\db\mysql\Schema;

/**
 * Class m160306_080017_create_fpm_file_table
 */
class m160306_080017_create_fpm_file_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%fpm_file}}',
            [
                'id' => Schema::TYPE_PK,
                'extension' => Schema::TYPE_STRING . '(10) NOT NULL COMMENT "File extension"',
                'base_name' => Schema::TYPE_STRING . '(250) NULL DEFAULT NULL COMMENT "File base name"',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%fpm_file}}');
    }
}
