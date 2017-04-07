<?php

use yii\db\Migration;

/**
 * Handles adding author_id to table `coach`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170407_112234_add_author_id_column_to_coach_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('coach', 'author_id', $this->integer()->notNull()->defaultValue(1));

        // creates index for column `author_id`
        $this->createIndex(
            'idx-coach-author_id',
            'coach',
            'author_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-coach-author_id',
            'coach',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-coach-author_id',
            'coach'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-coach-author_id',
            'coach'
        );

        $this->dropColumn('coach', 'author_id');
    }
}
