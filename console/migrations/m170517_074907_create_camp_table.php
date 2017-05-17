<?php

use yii\db\Migration;

/**
 * Handles the creation for table `camp`.
 */
class m170517_074907_create_camp_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('camp', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'country' => $this->string()->notNull(),
            'region' => $this->string()->notNull(),
            'place' => $this->string()->notNull(),
            'coord_lon' => $this->float(),
            'coord_lat' => $this->float(),
            'date_start' => $this->date(),
            'date_end' => $this->date(),
            'max_user_count' => $this->integer(),
            'promo' => $this->text()->notNull(),
            'description' => $this->text()->notNull(),
            'image_id' => $this->integer(),
            'price' => $this->integer(),
            'currency' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('camp');
    }
}
