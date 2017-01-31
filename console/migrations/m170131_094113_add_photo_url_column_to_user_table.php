<?php

use yii\db\Migration;

/**
 * Handles adding photo_url to table `user`.
 */
class m170131_094113_add_photo_url_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'photo_url', $this->string(1024));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'photo_url');
    }
}
