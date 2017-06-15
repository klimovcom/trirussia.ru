<?php

use yii\db\Migration;

/**
 * Handles adding send_training_message to table `user`.
 */
class m170615_102339_add_send_training_message_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'send_training_message', $this->boolean());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'send_training_message');
    }
}
