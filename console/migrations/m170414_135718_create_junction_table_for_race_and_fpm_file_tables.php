<?php

use yii\db\Migration;

/**
 * Handles the creation for table `race_fpm_file`.
 * Has foreign keys to the tables:
 *
 * - `race`
 * - `fpm_file`
 */
class m170414_135718_create_junction_table_for_race_and_fpm_file_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('race_fpm_file', [
            'race_id' => $this->integer(),
            'fpm_file_id' => $this->integer(),
            'type' => $this->boolean(),
            'PRIMARY KEY(race_id, fpm_file_id)',
        ]);

        // creates index for column `race_id`
        $this->createIndex(
            'idx-race_fpm_file-race_id',
            'race_fpm_file',
            'race_id'
        );

        // add foreign key for table `race`
        $this->addForeignKey(
            'fk-race_fpm_file-race_id',
            'race_fpm_file',
            'race_id',
            'race',
            'id',
            'CASCADE'
        );

        // creates index for column `fpm_file_id`
        $this->createIndex(
            'idx-race_fpm_file-fpm_file_id',
            'race_fpm_file',
            'fpm_file_id'
        );

        // add foreign key for table `fpm_file`
        $this->addForeignKey(
            'fk-race_fpm_file-fpm_file_id',
            'race_fpm_file',
            'fpm_file_id',
            'fpm_file',
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
            'fk-race_fpm_file-race_id',
            'race_fpm_file'
        );

        // drops index for column `race_id`
        $this->dropIndex(
            'idx-race_fpm_file-race_id',
            'race_fpm_file'
        );

        // drops foreign key for table `fpm_file`
        $this->dropForeignKey(
            'fk-race_fpm_file-fpm_file_id',
            'race_fpm_file'
        );

        // drops index for column `fpm_file_id`
        $this->dropIndex(
            'idx-race_fpm_file-fpm_file_id',
            'race_fpm_file'
        );

        $this->dropTable('race_fpm_file');
    }
}
