<?php

use yii\db\Migration;

class m170520_095825_alter_table_organizer extends Migration
{
    public $tableName = 'organizer';

    public function up()
    {
        $this->alterColumn($this->tableName, 'country', $this->string());
        $this->alterColumn($this->tableName, 'site', $this->string());
        $this->alterColumn($this->tableName, 'image_id', $this->integer());
        $this->alterColumn($this->tableName, 'promo', $this->text());
    }

    public function down()
    {
        return true;
    }
}
