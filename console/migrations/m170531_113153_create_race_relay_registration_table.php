<?php

use yii\db\Migration;

/**
 * Handles the creation for table `race_relay_registration`.
 * Has foreign keys to the tables:
 *
 * - `race`
 * - `distance`
 * - `user`
 */
class m170531_113153_create_race_relay_registration_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('race_relay_registration', [
            'id' => $this->primaryKey(),
            'race_id' => $this->integer()->notNull(),
            'distance_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'group' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull(),
            'is_first' => $this->boolean(),
            'send_notifications' => $this->boolean(),
            'time' => $this->string()->notNull(),
        ]);

        // creates index for column `race_id`
        $this->createIndex(
            'idx-race_relay_registration-race_id',
            'race_relay_registration',
            'race_id'
        );

        // add foreign key for table `race`
        $this->addForeignKey(
            'fk-race_relay_registration-race_id',
            'race_relay_registration',
            'race_id',
            'race',
            'id',
            'CASCADE'
        );

        // creates index for column `distance_id`
        $this->createIndex(
            'idx-race_relay_registration-distance_id',
            'race_relay_registration',
            'distance_id'
        );

        // add foreign key for table `distance`
        $this->addForeignKey(
            'fk-race_relay_registration-distance_id',
            'race_relay_registration',
            'distance_id',
            'distance',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-race_relay_registration-user_id',
            'race_relay_registration',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-race_relay_registration-user_id',
            'race_relay_registration',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `race`
        $this->dropForeignKey(
            'fk-race_relay_registration-race_id',
            'race_relay_registration'
        );

        // drops index for column `race_id`
        $this->dropIndex(
            'idx-race_relay_registration-race_id',
            'race_relay_registration'
        );

        // drops foreign key for table `distance`
        $this->dropForeignKey(
            'fk-race_relay_registration-distance_id',
            'race_relay_registration'
        );

        // drops index for column `distance_id`
        $this->dropIndex(
            'idx-race_relay_registration-distance_id',
            'race_relay_registration'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-race_relay_registration-user_id',
            'race_relay_registration'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-race_relay_registration-user_id',
            'race_relay_registration'
        );

        $this->dropTable('race_relay_registration');
    }
}
