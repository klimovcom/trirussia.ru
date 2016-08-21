<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 6/13/16
 * Time: 10:17 AM
 * @var array $moreRaces
 * @var $this \yii\base\View
 */
use willGo\models\WillGo;
$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';

?>
<?php /** @var $moreRaces \race\models\Race */ ?>
<?php foreach ($moreRaces as $race) {?>
    <tr>
        <td>
            <?php if ($race->isJoined()) { ?>
                <span
                    class="span-join"
                    title="Вы участвуете"
                    data-message-joined="Вы участвуете"
                    data-message-will="Нажмите, чтобы добавить в календарь"
                >
                                <i
                                    <?= $quest; ?>
                                    class="fa gold fa-star grey i-will-go already-joined"
                                    data-message="will"
                                    aria-hidden="true"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::dismissUrl(); ?>"
                                ></i>
                                <i
                                    <?= $quest; ?>
                                    class="fa fa-star-o grey i-will-go will-join hidden"
                                    aria-hidden="true"
                                    data-message="joined"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::joinUrl(); ?>"
                                ></i>
                            </span>
            <?php } else { ?>
                <span
                    class="span-join"
                    title="Нажмите, чтобы добавить в календарь"
                    data-message-joined="Вы участвуете"
                    data-message-will="Нажмите, чтобы добавить в календарь"
                >
                                <i
                                    <?= $quest; ?>
                                    class="fa gold fa-star grey i-will-go already-joined hidden"
                                    data-message="will"
                                    aria-hidden="true"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::dismissUrl(); ?>"
                                ></i>
                                <i
                                    <?= $quest; ?>
                                    class="fa fa-star-o grey i-will-go will-join"
                                    aria-hidden="true"
                                    data-message="joined"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::joinUrl(); ?>"
                                ></i>
                            </span>
            <?php } ?>

        </td>
        <td><?=  date('d.m.Y', strtotime($race->start_date)); ?></td>
        <td>
            <a href="#" data-toggle="tooltip" data-placement="left" class="no-underline" title="<?= $race->sport->label; ?>">
                <i class="fa fa-circle <?= $race->getSportClass();?>"></i>
            </a>&nbsp;<a href="<?= \yii\helpers\Url::to(['/race/default/view', 'url' => $race->url, ])?>" class="underline"><?= $race->label; ?></a>
        </td>
        <td><?= $race->region ?></td>
        <td><?= $race->getDistancesRepresentation(); ?></td>
        <td><?= $race->organizer->label; ?><td>
    </tr>
<?php } ?>