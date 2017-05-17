<?php

use yii\db\Migration;

/**
 * Handles adding published to table `camp`.
 */
class m170517_084147_add_published_column_to_camp_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('camp', 'published', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('camp', 'published');
    }
}
