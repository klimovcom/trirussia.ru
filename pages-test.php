#!/usr/bin/env php
<?php
mb_internal_encoding('UTF-8');
function file_get_contents_curl($url){
    $html = file_get_contents($url);
    preg_match("/\<title.*\>(.*)\<\/title\>/isU", $html, $matches);
    return $matches[1];
}

$params = array(
    'checks' => array(
        'https://prosto.insure/team' => 'Команда',
        'https://prosto.insure/press' => 'Информация для прессы',
        'https://prosto.insure/partners' => 'Информация для партнёров',
        'https://prosto.insure/investors' => 'Информация для инвесторов',
        'https://prosto.insure/payment' => 'Варианты оплаты страховок',
        'https://prosto.insure/policy' => 'Электронные страховые полисы',
        'https://prosto.insure/prostocheck' => 'Проверить надёжность компании',
        'https://prosto.insure/details' => 'Реквизиты компании',
        'https://osago.prosto.insure' => 'это страховка осаго в онлайне',
        'https://casco.prosto.insure' => 'это страховка каско в 15 компаниях в онлайне',
        'https://travel.prosto.insure' => 'это страховка для туристов в онлайне',
        'https://prosto.insure/greencard' => 'Зелёная карта',
        'https://prosto.insure/med' => 'Страхование ДМС и медицинские страховки в онлайне',
        'https://prosto.insure/accident' => 'Страхование от несчастного случая',
        'https://prosto.insure/corporate' => 'Страхование юридических лиц',
        'https://prosto.insure/kbm' => 'Калькулятор скидки на осаго (КБМ РСА)',
    ),
    'adminEmail' => array(
        'fkbr1993@yandex.ru',
        'mail@prosto.insure',
    ),
);

foreach ($params['checks'] as $url => $title){
    $responseTitle = file_get_contents_curl($url);
    if (mb_strpos($responseTitle, $title) !== false){
        print "URL: $url contains $title ($responseTitle)\n";
    } else {
        print "ERROR! URL: $url does not contains $title\n in ($responseTitle)";
        foreach ($params['adminEmail'] as $email){
            $header_array = array(
                "MIME-Version: 1.0",
                "Content-type: text/html; charset=UTF-8",
                "From: artemklim@ava.timeweb.ru",
                "Reply-To: mail@prosto.insure"
            );

            $headers = implode("\r\n", $header_array);

            @mail($email,
                "\nTest error https://prosto.insure/ -" . date('Y-m-d H:i:s'),
                "Ошибка произошла при попытке найти на странице $url тег title содержащий '$title''",
                $headers
            );
        }
        break;
    }
}

print "\n";








