<?php

use yii\db\Migration;

/**
 * Handles adding published_and_is_on_moderation to table `coach`.
 */
class m170221_091553_add_published_and_is_on_moderation_column_to_coach_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('coach', 'published', $this->boolean()->notNull());
        $this->addColumn('coach', 'is_on_moderation', $this->boolean()->notNull());

        $this->update('coach', ['published'=> 1, 'is_on_moderation' => 0]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('coach', 'published');
        $this->dropColumn('coach', 'is_on_moderation');
    }
}
