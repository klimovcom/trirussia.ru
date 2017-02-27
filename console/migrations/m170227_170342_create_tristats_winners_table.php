<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tristats_winners`.
 * Has foreign keys to the tables:
 *
 * - `tristats_races`
 */
class m170227_170342_create_tristats_winners_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tristats_winners', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'country' => $this->string(),
            'division' => $this->string(),
            'division_rank' => $this->integer(),
            'swim' => $this->string(),
            'run' => $this->string(),
            'bike' => $this->string(),
            'finish' => $this->string(),
            'tristats_race_id' => $this->integer(),
        ]);

        // creates index for column `tristats_race_id`
        $this->createIndex(
            'idx-tristats_winners-tristats_race_id',
            'tristats_winners',
            'tristats_race_id'
        );

        // add foreign key for table `tristats_races`
        $this->addForeignKey(
            'fk-tristats_winners-tristats_race_id',
            'tristats_winners',
            'tristats_race_id',
            'tristats_races',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `tristats_races`
        $this->dropForeignKey(
            'fk-tristats_winners-tristats_race_id',
            'tristats_winners'
        );

        // drops index for column `tristats_race_id`
        $this->dropIndex(
            'idx-tristats_winners-tristats_race_id',
            'tristats_winners'
        );

        $this->dropTable('tristats_winners');
    }
}
