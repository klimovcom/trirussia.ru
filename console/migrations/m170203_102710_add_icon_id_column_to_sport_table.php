<?php

use yii\db\Migration;

/**
 * Handles adding icon_id to table `sport`.
 */
class m170203_102710_add_icon_id_column_to_sport_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sport', 'icon_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sport', 'icon_id');
    }
}
