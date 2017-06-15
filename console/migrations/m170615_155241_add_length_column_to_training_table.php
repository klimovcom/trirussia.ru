<?php

use yii\db\Migration;

/**
 * Handles adding length to table `training`.
 */
class m170615_155241_add_length_column_to_training_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('training', 'length', $this->string()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('training', 'length');
    }
}
