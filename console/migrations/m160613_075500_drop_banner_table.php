<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `banner_table`.
 */
class m160613_075500_drop_banner_table extends Migration
{
    public $tableName = '{{%banner}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable($this->tableName);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'label' => $this->string(),
            'image_id' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }
}
