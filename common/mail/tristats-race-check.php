<?php
if (count($added)) {
    $result = 'Найдены новые гонки' . "\r\n";
    foreach ($added as $item) {
        $result .= $item['name'] . "\r\n";
    }
    if (count($finded)) {
        $result .= 'Найдены совпадения с нашими гонками' ."\r\n";
        foreach ($finded as $item) {
            $result .= $item['tr_race'] . ' (id:' . $item['tr_race_id']. ') : ' . $item['race'] . ' (id:' . $item['race_id']. ')' .  "\r\n";
        }
    }
}else {
    $result = 'Нет новых гонок';
}
echo $result;