<?php

use yii\db\Migration;

/**
 * Handles adding register to table `race`.
 */
class m170414_124904_add_register_column_to_race_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('race', 'with_registration', $this->boolean()->defaultValue(false));
        $this->addColumn('race', 'contact_phone', $this->string());
        $this->addColumn('race', 'contact_email', $this->string());
        $this->addColumn('race', 'date_register_begin', $this->integer());
        $this->addColumn('race', 'date_register_end', $this->integer());
        $this->addColumn('race', 'register_status', $this->integer());
        $this->addColumn('race', 'racers_limit', $this->integer());
        $this->addColumn('race', 'show_racers_list', $this->boolean());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('race', 'with_registration');
        $this->dropColumn('race', 'contact_phone');
        $this->dropColumn('race', 'contact_email');
        $this->dropColumn('race', 'date_register_begin');
        $this->dropColumn('race', 'date_register_end');
        $this->dropColumn('race', 'register_status');
        $this->dropColumn('race', 'racers_limit');
        $this->dropColumn('race', 'show_racers_list');
    }
}
