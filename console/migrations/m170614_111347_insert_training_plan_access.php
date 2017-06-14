<?php

use yii\db\Migration;

class m170614_111347_insert_training_plan_access extends Migration
{
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'training_plan',
            'type' => '2',
            'description' => 'Тренировочные планы - полный доступ',
            'created_at' => '1497439922',
            'updated_at' => '1497439922',
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'admin',
            'child' => 'training_plan',
        ]);
    }

    public function down()
    {
        return true;
    }
}
