<?php

use yii\db\Migration;

/**
 * Handles adding og_image_id to table `seo`.
 */
class m170523_043504_add_og_image_id_column_to_seo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('seo', 'og_image_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('seo', 'og_image_id');
    }
}
