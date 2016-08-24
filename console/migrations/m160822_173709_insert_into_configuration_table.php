<?php

use yii\db\Migration;

class m160822_173709_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';
    
    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: стандартное описание',
            'description' => 'Сео: стандартное описание в теге description',
            'key' => 'seo_standard_description',
            'value' => 'Вся информация о соревнованиях по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам. Старты в России, в Москве, гонки серии Ironman, Ironstar, Титан, Гром, олимпийские дистанции и спринты',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для статической страницы about',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_about_page_description',
            'value' => 'Вся информация о соревнованиях по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам. Старты в России, в Москве, гонки серии Ironman, Ironstar, Титан, Гром, олимпийские дистанции и спринты',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для статической страницы advertising',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_advertising_page_description',
            'value' => 'Вся информация о соревнованиях по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам. Старты в России, в Москве, гонки серии Ironman, Ironstar, Титан, Гром, олимпийские дистанции и спринты',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для статической страницы domains',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_domains_page_description',
            'value' => 'Вся информация о соревнованиях по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам. Старты в России, в Москве, гонки серии Ironman, Ironstar, Титан, Гром, олимпийские дистанции и спринты',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для статической страницы bmi',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_bmi_page_description',
            'value' => 'Вся информация о соревнованиях по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам. Старты в России, в Москве, гонки серии Ironman, Ironstar, Титан, Гром, олимпийские дистанции и спринты',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для статической страницы convert',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_bmi_convert_description',
            'value' => 'Вся информация о соревнованиях по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам. Старты в России, в Москве, гонки серии Ironman, Ironstar, Титан, Гром, олимпийские дистанции и спринты',
        ]);


        $this->insert($this->tableName, [
            'label' => 'Сео: описание для страницы просмотра гонки',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_race_view_page_description',
            'value' => '{racePromo}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для страницы просмотра поиска соревнований',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_race_search_page_description',
            'value' => 'Выбирайте соревнования по триатлону, бегу, плаванию, велоспорту, лыжам и дуатлону. Полное описание и регистрация на лучшие старты',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для страницы просмотра вида спорта',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_race_sport_page_description',
            'value' => 'Выбирайте соревнования по триатлону, бегу, плаванию, велоспорту, лыжам и дуатлону. Полное описание и регистрация на лучшие старты',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для главной страницы',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_main_page_description',
            'value' => 'Вся информация о соревнованиях по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам. Старты в России, в Москве, гонки серии Ironman, Ironstar, Титан, Гром, олимпийские дистанции и спринты',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для журнала',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_magazine_page_description',
            'value' => 'Журнал о триатлоне, беге, плавании, велоспорте, дуатлону и лыжам. Как тренироваться и вести здоровый образ жизни.',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: описание для статьи журнала',
            'description' => 'Сео: описание в теге description',
            'key' => 'seo_magazine_post_page_description',
            'value' => '{articlePromo}',
        ]);
    }

    public function down()
    {
        return true;
    }
}
