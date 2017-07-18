<?php

use yii\db\Migration;

/**
 * Handles adding api_key to table `user`.
 */
class m170718_130447_add_api_key_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'api_key', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'api_key');
    }
}
