<?php

use yii\db\Migration;

/**
 * Handles adding is_sended_email_to_author to table `race`.
 */
class m170604_171402_add_is_sended_email_to_author_column_to_race_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('race', 'is_sended_email_to_author', $this->boolean()->defaultValue(0));
        $this->update('race', ['is_sended_email_to_author' => 1], ['published' => 1]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('race', 'is_sended_email_to_organizer');
    }
}
