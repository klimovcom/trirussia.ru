<?php

use yii\db\Migration;

/**
 * Handles adding popularity to table `product`.
 */
class m161209_095303_add_popularity_column_to_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'popularity', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'popularity');
    }
}
