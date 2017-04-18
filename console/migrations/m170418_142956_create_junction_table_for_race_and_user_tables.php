<?php

use yii\db\Migration;

/**
 * Handles the creation for table `race_registration`.
 * Has foreign keys to the tables:
 *
 * - `race`
 * - `user`
 */
class m170418_142956_create_junction_table_for_race_and_user_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('race_registration', [
            'race_id' => $this->integer(),
            'user_id' => $this->integer(),
            'PRIMARY KEY(race_id, user_id)',
        ]);

        // creates index for column `race_id`
        $this->createIndex(
            'idx-race_registration-race_id',
            'race_registration',
            'race_id'
        );

        // add foreign key for table `race`
        $this->addForeignKey(
            'fk-race_registration-race_id',
            'race_registration',
            'race_id',
            'race',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-race_registration-user_id',
            'race_registration',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-race_registration-user_id',
            'race_registration',
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
            'fk-race_registration-race_id',
            'race_registration'
        );

        // drops index for column `race_id`
        $this->dropIndex(
            'idx-race_registration-race_id',
            'race_registration'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-race_registration-user_id',
            'race_registration'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-race_registration-user_id',
            'race_registration'
        );

        $this->dropTable('race_registration');
    }
}
