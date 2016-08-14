<?php

use yii\db\Migration;

/**
 * Handles the creation for table `cache_table`.
 */
class m160814_211310_create_cache_table extends Migration
{
    public $tableName = '{{%cache}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id char(128) NOT NULL PRIMARY KEY',
            'expire int(11)',
            'data BLOB'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
