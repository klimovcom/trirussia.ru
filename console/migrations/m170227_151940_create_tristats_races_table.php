<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tristats_races`.
 */
class m170227_151940_create_tristats_races_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tristats_races', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'year' => $this->integer()->notNull(),
            'race_id' => $this->integer()->notNull(),
            'race_url' => $this->string(1024)->notNull(),
            'date' => $this->date(),
            'place' => $this->string()->notNull(),
            'racer_count' => $this->integer(),
            'min_swim' => $this->string(),
            'min_bike' => $this->string(),
            'min_run' => $this->string(),
            'min_finish' => $this->string(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tristats_races');
    }
}
