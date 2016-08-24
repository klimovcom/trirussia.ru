<?php

use yii\db\Migration;

/**
 * Class m160822_053201_insert_into_configuration_table
 */
class m160822_053201_insert_into_configuration_table extends Migration
{
    public $tableName = '{{%configuration}}';

    public function up()
    {
        $this->truncateTable($this->tableName);


        //author
        $this->insert($this->tableName, [
            'label' => 'Сео: стандартный автор',
            'description' => 'Сео: стандартный автор в теге author (на всех страницах, кроме журнальной записи)',
            'key' => 'seo_standard_author',
            'value' => 'TriRussia.ru',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: автор журнальной записи',
            'description' => 'Сео: Автор в теге author на странице журнальной записи',
            'key' => 'seo_post_page_author',
            'value' => '{postAuthorFullName}',
        ]);

        //keywords
        $this->insert($this->tableName, [
            'label' => 'Сео: стандартные ключевые слова',
            'description' => 'Сео: стандартные ключевые слова в теге keywords',
            'key' => 'seo_standard_keywords',
            'value' => 'Триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт, суперспринт, 5 км, 10 км, календарь соревнований',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для статической страницы about',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_about_page_keywords',
            'value' => 'Триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт, суперспринт, 5 км, 10 км, календарь соревнований',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для статической страницы advertising',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_advertising_page_keywords',
            'value' => 'Триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт, суперспринт, 5 км, 10 км, календарь соревнований',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для статической страницы domains',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_domains_page_keywords',
            'value' => 'Триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт, суперспринт, 5 км, 10 км, календарь соревнований',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для статической страницы bmi',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_bmi_page_keywords',
            'value' => 'Триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт, суперспринт, 5 км, 10 км, календарь соревнований',
        ]);
        
        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для статической страницы convert',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_bmi_convert_keywords',
            'value' => 'Триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт, суперспринт, 5 км, 10 км, календарь соревнований',
        ]);


        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для страницы просмотра гонки',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_race_view_page_keywords',
            'value' => '{raceLabel}, {raceStartDate:dd.M.yyyy}, {raceCountry}, {raceRegion}, {racePlace}, {raceSportLabel}, {raceDistanceCategoryLabel}, {raceOrganizerLabel}',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для страницы просмотра поиска соревнований',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_race_search_page_keywords',
            'value' => 'триатлон, бег, плавание, велоспорт, дуатлон, [triathlonKeywords], [runKeywords]',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для страницы просмотра вида спорта',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_race_sport_page_keywords',
            'value' => '{sportLabel}, [triathlonKeywords], {sportLabel} в Москве, {sportLabel} в России',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для главной страницы',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_main_page_keywords',
            'value' => 'Триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт, суперспринт, 5 км, 10 км, календарь соревнований',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для журнала',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_magazine_page_keywords',
            'value' => 'Журнал, триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт',
        ]);

        $this->insert($this->tableName, [
            'label' => 'Сео: ключевые слова для статьи журнала',
            'description' => 'Сео: ключевые слова в теге keywords',
            'key' => 'seo_magazine_post_page_keywords',
            'value' => '{postTags}, TriRussia.ru, журнал, статья, спорт, триатлон, бег, плавание, ЗОЖ, велоспорт, дуатлон, лыжи, питание',
        ]);
    }

    public function down()
    {
        $this->truncateTable($this->tableName);
    }
}
