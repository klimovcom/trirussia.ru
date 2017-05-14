<?php

use yii\db\Migration;

class m170514_010859_change_race_registration_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
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

        $this->createTable('race_registration', [
            'race_id' => $this->integer(),
            'user_id' => $this->integer(),
            'distance_id' => $this->integer(),
            'distance_type' => $this->integer(),
            'PRIMARY KEY(race_id, user_id, distance_id, distance_type)',
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
