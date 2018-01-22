<?php

use yii\db\Migration;

class m180122_183104_addTitanRegistration extends Migration
{
    public $tableName = 'titan_registration';

    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'race_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'birth_date' => $this->date()->notNull(),
            'gender' => $this->integer()->notNull(),
            'primary_phone' => $this->string()->notNull(),
            'primary_email' => $this->string()->notNull(),
            'emergency_phone' => $this->string()->notNull(),
            'status' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
