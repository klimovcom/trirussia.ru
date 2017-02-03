<?php

use yii\db\Migration;

/**
 * Handles adding url to table `coach`.
 */
class m170203_104655_add_url_column_to_coach_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('coach', 'url', $this->string()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('coach', 'url');
    }
}
