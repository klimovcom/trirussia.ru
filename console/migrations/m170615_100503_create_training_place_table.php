<?php

use yii\db\Migration;

/**
 * Handles the creation for table `training_place`.
 */
class m170615_100503_create_training_place_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('training_place', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('training_place');
    }
}
