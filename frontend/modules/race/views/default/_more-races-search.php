<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 6/13/16
 * Time: 10:17 AM
 * @var array $moreRaces
 * @var $this \yii\base\View
 */
use \willGo\models\WillGo;

$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';
?>
        <?php foreach ($moreRaces as $race) {?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <li class="flex-item">
                    <div class="card">
                        <div class="card-block border-<?= $race->getSportClass(); ?>">
                            <div class="pull-left">
                                <h6 class="sport-caption <?= $race->getSportClass(); ?>"><?= $race->sport->label; ?></h6>
                            </div>
                            <div class="pull-right">
                                <h6 class="date-caption grey"><?= $race->getDateRepresentation(); ?></h6>
                            </div>
                            <div class="clearfix"></div>
                            <h4 class="card-title">
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
                                                aria-hidden="joined"
                                                data-message="will"
                                                data-id="<?= $race->id; ?>"
                                                data-url="<?= WillGo::joinUrl(); ?>"
                                            ></i>
                                        </span>
                                <?php } ?>
                                <a href="<?= \yii\helpers\Url::to(['/race/default/view', 'url' => $race->url, ])?>" class="underline-black">
                                    <?= $race->label; ?>
                                </a>
                            </h4>
                            <p class="card-text"><?= $race->promo; ?></p>
                            <a href="<?= \yii\helpers\Url::to(['/race/default/view', 'url' => $race->url, ])?>" class="btn btn-secondary btn-sm">Узнайте больше</a>
                        </div>
                    </div>
                </li>
            </div>
        <?php } ?>