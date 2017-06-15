<?php

use yii\db\Migration;

class m170615_103119_insert_training_access extends Migration
{
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'training',
            'type' => '2',
            'description' => 'Тренировки - полный доступ',
            'created_at' => '1497439922',
            'updated_at' => '1497439922',
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'admin',
            'child' => 'training',
        ]);
    }

    public function down()
    {
        return true;
    }
}
