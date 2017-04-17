<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_info`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170417_123612_create_user_info_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_info', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'gender' => $this->boolean()->notNull(),
            'birthdate' => $this->date()->notNull(),
            'city' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'emergency_first_name' => $this->string()->notNull(),
            'emergency_last_name' => $this->string()->notNull(),
            'emergency_phone' => $this->string()->notNull(),
            'emergency_relation' => $this->string()->notNull(),
            'team' => $this->string(),
            'shirt_size' => $this->string()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_info-user_id',
            'user_info',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_info-user_id',
            'user_info',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_info-user_id',
            'user_info'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_info-user_id',
            'user_info'
        );

        $this->dropTable('user_info');
    }
}
