<?php

use yii\db\Migration;

/**
 * Handles the creation for table `camp_sport`.
 * Has foreign keys to the tables:
 *
 * - `camp`
 * - `sport`
 */
class m170517_075053_create_junction_table_for_camp_and_sport_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('camp_sport', [
            'camp_id' => $this->integer(),
            'sport_id' => $this->integer(),
            'PRIMARY KEY(camp_id, sport_id)',
        ]);

        // creates index for column `camp_id`
        $this->createIndex(
            'idx-camp_sport-camp_id',
            'camp_sport',
            'camp_id'
        );

        // add foreign key for table `camp`
        $this->addForeignKey(
            'fk-camp_sport-camp_id',
            'camp_sport',
            'camp_id',
            'camp',
            'id',
            'CASCADE'
        );

        // creates index for column `sport_id`
        $this->createIndex(
            'idx-camp_sport-sport_id',
            'camp_sport',
            'sport_id'
        );

        // add foreign key for table `sport`
        $this->addForeignKey(
            'fk-camp_sport-sport_id',
            'camp_sport',
            'sport_id',
            'sport',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `camp`
        $this->dropForeignKey(
            'fk-camp_sport-camp_id',
            'camp_sport'
        );

        // drops index for column `camp_id`
        $this->dropIndex(
            'idx-camp_sport-camp_id',
            'camp_sport'
        );

        // drops foreign key for table `sport`
        $this->dropForeignKey(
            'fk-camp_sport-sport_id',
            'camp_sport'
        );

        // drops index for column `sport_id`
        $this->dropIndex(
            'idx-camp_sport-sport_id',
            'camp_sport'
        );

        $this->dropTable('camp_sport');
    }
}
