<?php

use yii\db\Migration;

/**
 * Handles the creation for table `training_plan`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `sport`
 */
class m170614_104554_create_training_plan_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('training_plan', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'level' => $this->integer()->notNull(),
            'count' => $this->string()->notNull(),
            'amount' => $this->string()->notNull(),
            'progress' => $this->string()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'author_name' => $this->string()->notNull(),
            'author_site' => $this->string(1024)->notNull(),
            'format' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'duration' => $this->string()->notNull(),
            'sport_id' => $this->integer()->notNull(),
            'popularity' => $this->integer()->defaultValue(0),
            'promo' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'published' => $this->integer()->notNull(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-training_plan-author_id',
            'training_plan',
            'author_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-training_plan-author_id',
            'training_plan',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `sport`
        $this->createIndex(
            'idx-training_plan-sport',
            'training_plan',
            'sport_id'
        );

        // add foreign key for table `sport`
        $this->addForeignKey(
            'fk-training_plan-sport',
            'training_plan',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-training_plan-author_id',
            'training_plan'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-training_plan-author_id',
            'training_plan'
        );

        // drops foreign key for table `sport`
        $this->dropForeignKey(
            'fk-training_plan-sport',
            'training_plan'
        );

        // drops index for column `sport`
        $this->dropIndex(
            'idx-training_plan-sport',
            'training_plan'
        );

        $this->dropTable('training_plan');
    }
}
