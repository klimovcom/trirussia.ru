<?php

use yii\db\Migration;

/**
 * Handles the creation for table `banner_table`.
 */
class m160605_210657_create_banner_table extends Migration
{
    public $tableName = '{{%banner}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'label' => $this->string(),
            'image_id' => $this->integer(),
            'status' => $this->integer(),
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
