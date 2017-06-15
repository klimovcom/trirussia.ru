<?php

use yii\db\Migration;

/**
 * Handles the creation for table `training`.
 * Has foreign keys to the tables:
 *
 * - `training_place`
 * - `sport`
 * - `user`
 */
class m170615_101621_create_training_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('training', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'date' => $this->date()->notNull(),
            'time' => $this->string(5),
            'place_id' => $this->integer(),
            'sport_id' => $this->integer()->notNull(),
            'level' => $this->string(),
            'price' => $this->integer()->defaultValue(0),
            'currency' => $this->integer()->notNull(),
            'trainer_name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'promo' => $this->text(),
            'author_id' => $this->integer()->notNull(),
            'published' => $this->boolean()->notNull(),
        ]);

        // creates index for column `place_id`
        $this->createIndex(
            'idx-training-place_id',
            'training',
            'place_id'
        );

        // add foreign key for table `training_place`
        $this->addForeignKey(
            'fk-training-place_id',
            'training',
            'place_id',
            'training_place',
            'id',
            'CASCADE'
        );

        // creates index for column `sport_id`
        $this->createIndex(
            'idx-training-sport_id',
            'training',
            'sport_id'
        );

        // add foreign key for table `sport`
        $this->addForeignKey(
            'fk-training-sport_id',
            'training',
            'sport_id',
            'sport',
            'id',
            'CASCADE'
        );

        // creates index for column `author_id`
        $this->createIndex(
            'idx-training-author_id',
            'training',
            'author_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-training-author_id',
            'training',
            'author_id',
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
        // drops foreign key for table `training_place`
        $this->dropForeignKey(
            'fk-training-place_id',
            'training'
        );

        // drops index for column `place_id`
        $this->dropIndex(
            'idx-training-place_id',
            'training'
        );

        // drops foreign key for table `sport`
        $this->dropForeignKey(
            'fk-training-sport_id',
            'training'
        );

        // drops index for column `sport_id`
        $this->dropIndex(
            'idx-training-sport_id',
            'training'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-training-author_id',
            'training'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-training-author_id',
            'training'
        );

        $this->dropTable('training');
    }
}
