<?php

use yii\db\Migration;

class m160822_180357_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';
    
    public function up()
    {
        $this->insert($this->tableName, [
            'label' => 'Сео: стандартный заголовок',
            'description' => 'Сео: стандартный заголовок в теге title',
            'key' => 'seo_standard_title',
            'value' => 'TriRussia.ru — Календарь соревнований по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для статической страницы about',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_about_page_title',
            'value' => 'TriRussia.ru — Календарь соревнований по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для статической страницы advertising',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_advertising_page_title',
            'value' => 'TriRussia.ru — Календарь соревнований по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для статической страницы domains',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_domains_page_title',
            'value' => 'TriRussia.ru — Календарь соревнований по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для статической страницы bmi',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_bmi_page_title',
            'value' => 'TriRussia.ru — Календарь соревнований по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для статической страницы convert',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_bmi_convert_title',
            'value' => 'TriRussia.ru — Календарь соревнований по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам',
        ]);


        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для страницы просмотра гонки',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_race_view_page_title',
            'value' => '{raceLabel}, {raceCountry}, {racePlace}, {raceSportLabel} {raceStartDate:dd.M.yyyy}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для страницы просмотра поиска соревнований',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_race_search_page_title',
            'value' => 'TriRussia.ru — Календарь соревнований {sportCondition}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для страницы просмотра вида спорта',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_race_sport_page_title',
            'value' => 'Календарь соревнований по {sportLabel:дательный} {sportCondition}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для главной страницы',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_main_page_title',
            'value' => 'TriRussia.ru — Календарь соревнований по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для журнала',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_magazine_page_title',
            'value' => 'Журнал TriRussia.ru — Все самое интересное о триатлоне, беге, плавании и велоспорте',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: заголовок для статьи журнала',
            'description' => 'Сео: заголовок в теге title',
            'key' => 'seo_magazine_post_page_title',
            'value' => 'Журнал TriRussia.ru — {postTitle}',
        ]);
    }

    public function down()
    {
        return true;
    }
}
