<?php

use yii\db\Migration;

class m160822_181907_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: стандартное изображение',
            'description' => 'Сео: стандартное изображение в теге og:image',
            'key' => 'seo_standard_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для статической страницы about',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_about_page_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для статической страницы advertising',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_advertising_page_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для статической страницы domains',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_domains_page_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для статической страницы bmi',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_bmi_page_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для статической страницы convert',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_bmi_convert_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);


        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для страницы просмотра гонки',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_race_view_page_og_image',
            'value' => '{raceImageUrl}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для страницы просмотра поиска соревнований',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_race_search_page_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для страницы просмотра вида спорта',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_race_sport_page_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для главной страницы',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_main_page_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для журнала',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_magazine_page_og_image',
            'value' => 'http://www.trirussia.ru/img/og_logo.png',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: изображение для статьи журнала',
            'description' => 'Сео: изображение в теге og:image',
            'key' => 'seo_magazine_post_page_og_image',
            'value' => '{articleUrl}',
        ]);
    }

    public function down()
    {
        return true;
    }
}
