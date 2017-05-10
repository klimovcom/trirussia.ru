<?php

use yii\db\Migration;

/**
 * Handles adding api_key to table `organizer`.
 */
class m170510_104517_add_api_key_column_to_organizer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('organizer', 'api_key', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('organizer', 'api_key');
    }
}
