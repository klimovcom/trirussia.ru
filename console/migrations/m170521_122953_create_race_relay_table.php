<?php

use yii\db\Migration;

/**
 * Handles the creation for table `race_relay`.
 */
class m170521_122953_create_race_relay_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('race_relay', [
            'id' => $this->primaryKey(),
            'race_id' => $this->integer()->notNull(),
            'distance_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull(),
            'distance' => $this->integer(),
            'sport' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('race_relay');
    }
}
