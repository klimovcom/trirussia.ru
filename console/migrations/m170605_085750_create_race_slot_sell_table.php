<?php

use yii\db\Migration;

/**
 * Handles the creation for table `race_slot_sell`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `race`
 * - `distance`
 */
class m170605_085750_create_race_slot_sell_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('race_slot_sell', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'race_id' => $this->integer(),
            'distance_id' => $this->integer(),
            'type' => $this->boolean()->notNull(),
            'price' => $this->string()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-race_slot_sell-user_id',
            'race_slot_sell',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-race_slot_sell-user_id',
            'race_slot_sell',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `race_id`
        $this->createIndex(
            'idx-race_slot_sell-race_id',
            'race_slot_sell',
            'race_id'
        );

        // add foreign key for table `race`
        $this->addForeignKey(
            'fk-race_slot_sell-race_id',
            'race_slot_sell',
            'race_id',
            'race',
            'id',
            'CASCADE'
        );

        // creates index for column `distance_id`
        $this->createIndex(
            'idx-race_slot_sell-distance_id',
            'race_slot_sell',
            'distance_id'
        );

        // add foreign key for table `distance`
        $this->addForeignKey(
            'fk-race_slot_sell-distance_id',
            'race_slot_sell',
            'distance_id',
            'distance',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-race_slot_sell-user_id',
            'race_slot_sell'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-race_slot_sell-user_id',
            'race_slot_sell'
        );

        // drops foreign key for table `race`
        $this->dropForeignKey(
            'fk-race_slot_sell-race_id',
            'race_slot_sell'
        );

        // drops index for column `race_id`
        $this->dropIndex(
            'idx-race_slot_sell-race_id',
            'race_slot_sell'
        );

        // drops foreign key for table `distance`
        $this->dropForeignKey(
            'fk-race_slot_sell-distance_id',
            'race_slot_sell'
        );

        // drops index for column `distance_id`
        $this->dropIndex(
            'idx-race_slot_sell-distance_id',
            'race_slot_sell'
        );

        $this->dropTable('race_slot_sell');
    }
}
