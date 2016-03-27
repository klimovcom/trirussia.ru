<?php

use yii\db\Migration;

/**
 * Class m160327_083700_add_post_to_user_fk
 */
class m160327_083700_add_post_to_user_fk extends Migration
{
    public $tableName = '{{%post}}';

    public function up()
    {
        $this->addForeignKey('post_to_user_fk', $this->tableName, 'author_id', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('post_to_user_fk', $this->tableName);
    }
}
