<?php

use yii\db\Migration;

/**
 * Handles the creation for table `promocode`.
 */
class m170203_082419_create_promocode_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('promocode', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'promo' => $this->text(),
            'discount' => $this->integer()->notNull(),
            'conditions' => $this->text(),
            'promocode' => $this->string()->notNull(),
            'published' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('promocode');
    }
}
