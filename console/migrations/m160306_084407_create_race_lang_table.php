<?php

use yii\db\Migration;

/**
 * Class m160306_084407_create_race_lang_table
 */
class m160306_084407_create_race_lang_table extends Migration
{
    public $tableName = '{{%race_lang}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('race_lang', [
            'id' => $this->primaryKey(),
            'race_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'label' => $this->string(),
            'content' => $this->text(),
            'promo' => $this->text(),
            'country' => $this->string(),
            'region' => $this->string(),
            'place' => $this->string(),
            'currency' => $this->string(),
        ], $tableOptions);

        $this->addForeignKey('race_lang_ibfk_1', $this->tableName, 'race_id', '{{%race}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('race_lang_ibfk_1', $this->tableName);

        $this->dropTable($this->tableName);
    }
}
