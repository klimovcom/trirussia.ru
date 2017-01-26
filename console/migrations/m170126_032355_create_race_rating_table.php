<?php

use yii\db\Migration;

/**
 * Handles the creation for table `race_rating`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `race`
 */
class m170126_032355_create_race_rating_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('race_rating', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'race_id' => $this->integer()->notNull(),
            'rate' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-race_rating-user_id',
            'race_rating',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-race_rating-user_id',
            'race_rating',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `race_id`
        $this->createIndex(
            'idx-race_rating-race_id',
            'race_rating',
            'race_id'
        );

        // add foreign key for table `race`
        $this->addForeignKey(
            'fk-race_rating-race_id',
            'race_rating',
            'race_id',
            'race',
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
            'fk-race_rating-user_id',
            'race_rating'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-race_rating-user_id',
            'race_rating'
        );

        // drops foreign key for table `race`
        $this->dropForeignKey(
            'fk-race_rating-race_id',
            'race_rating'
        );

        // drops index for column `race_id`
        $this->dropIndex(
            'idx-race_rating-race_id',
            'race_rating'
        );

        $this->dropTable('race_rating');
    }
}
