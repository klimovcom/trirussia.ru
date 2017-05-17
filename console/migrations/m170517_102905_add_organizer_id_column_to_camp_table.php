<?php

use yii\db\Migration;

/**
 * Handles adding organizer_id to table `camp`.
 * Has foreign keys to the tables:
 *
 * - `organizer`
 */
class m170517_102905_add_organizer_id_column_to_camp_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('camp', 'organizer_id', $this->integer()->notNull());

        // creates index for column `organizer_id`
        $this->createIndex(
            'idx-camp-organizer_id',
            'camp',
            'organizer_id'
        );

        // add foreign key for table `organizer`
        $this->addForeignKey(
            'fk-camp-organizer_id',
            'camp',
            'organizer_id',
            'organizer',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `organizer`
        $this->dropForeignKey(
            'fk-camp-organizer_id',
            'camp'
        );

        // drops index for column `organizer_id`
        $this->dropIndex(
            'idx-camp-organizer_id',
            'camp'
        );

        $this->dropColumn('camp', 'organizer_id');
    }
}
