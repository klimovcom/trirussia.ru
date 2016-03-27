<?php

use yii\db\Migration;

/**
 * Class m160327_083521_add_race_to_user_fk
 */
class m160327_083521_add_race_to_user_fk extends Migration
{
    public $tableName = '{{%race}}';

    public function up()
    {
        $this->addForeignKey('race_to_user_fk', $this->tableName, 'author_id', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('race_to_user_fk', $this->tableName);
    }
}
