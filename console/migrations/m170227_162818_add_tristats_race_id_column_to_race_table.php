<?php

use yii\db\Migration;

/**
 * Handles adding tristats_race_id to table `race`.
 * Has foreign keys to the tables:
 *
 * - `tristats_race`
 */
class m170227_162818_add_tristats_race_id_column_to_race_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('race', 'tristats_race_id', $this->integer());

        // creates index for column `tristats_race_id`
        $this->createIndex(
            'idx-race-tristats_race_id',
            'race',
            'tristats_race_id'
        );

        // add foreign key for table `tristats_races`
        $this->addForeignKey(
            'fk-race-tristats_race_id',
            'race',
            'tristats_race_id',
            'tristats_races',
            'id',
            'SET NULL'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `tristats_race`
        $this->dropForeignKey(
            'fk-race-tristats_race_id',
            'race'
        );

        // drops index for column `tristats_race_id`
        $this->dropIndex(
            'idx-race-tristats_race_id',
            'race'
        );

        $this->dropColumn('race', 'tristats_race_id');
    }
}
