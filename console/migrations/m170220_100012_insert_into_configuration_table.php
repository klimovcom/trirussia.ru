<?php

use yii\db\Migration;

class m170220_100012_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок страницы добавления гонки',
            'description' => 'Сео: заголовок страницы добавления гонки',
            'key' => 'seo_race_create_page_title',
            'value' => 'Добавьте свою гонку на TriRussia.ru',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для страницы добавления гонки',
            'description' => 'Сео: описание страницы добавления гонки',
            'key' => 'seo_race_create_page_description',
            'value' => 'Добавьте свою гонку на TriRussia.ru',
        ]);
    }

    public function down()
    {
        return true;
    }
}
