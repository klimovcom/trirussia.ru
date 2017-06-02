<?php
use yii\helpers\Html;

echo Html::tag('p',  $first_user_name.', только что ' . $user_name .' ('. $user_email .') оставил заявку на участие в эстафете в вашей команде на соревновании ' . $race_label . ' (' . Html::a($race_label, $race_url) . ')');
echo Html::tag('p', $user_name . ' выбрал этап ' . $sport . ' с приблизительным временем этапа ' . $time . '.');
echo Html::tag('p', 'Ваши контактные данные были отправлены ' . $user_name . ' для того, чтобы вы могли скооперироваться и успешно выступить на эстафете.');
echo Html::tag('p', 'Если вы не хотите видеть этого спортсмена в вашей команде, то перейдите на страницу соревнования (' . Html::a($race_label, $race_url) . '), нажмите «Хочу в эстафету» и удалите участника из вашей команды.');
echo Html::tag('p', '');
echo Html::tag('p', 'С уважением,');
echo Html::tag('p', 'Команда TriRussia.ru');
