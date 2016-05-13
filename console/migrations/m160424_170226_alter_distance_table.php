<?php

use yii\db\Migration;

/**
 * Class m160424_170226_alter_distance_table
 */
class m160424_170226_alter_distance_table extends Migration
{
    public $tableName = '{{%distance}}';

    public function up()
    {
        $this->execute("SET foreign_key_checks = 0;");
        $this->dropTable($this->tableName);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'label' => $this->string(),

        ], $tableOptions);

        $this->execute("SET foreign_key_checks = 1;");
    }

    public function down()
    {
        $this->execute("SET foreign_key_checks = 0;");
        $this->dropTable($this->tableName);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'label' => $this->string(),

        ], $tableOptions);

        $this->execute("SET foreign_key_checks = 1;");
    }
}
