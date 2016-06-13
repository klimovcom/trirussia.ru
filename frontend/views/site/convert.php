<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 6/13/16
 * Time: 9:36 AM
 */
?>

<div class="container">
    <h1 class="m-t-3 m-b-3">Калькулятор темпа и скорости</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card card-block">
                <p>Умный супералгоритм время и дистанцию в темп в беге (время на 1 км) и темп в плавании (время на 100 метров)</p>
                <p>Наверняка вы слышали от друзей-спортсменов такое:<br>
                    — Да я вчера тысячу из 19 минут выплыл!<br>
                    — Как же круто, — можно подумать.
                </p>
                <p>А на самом деле ничего особенного: с темпом 1:52 на 100 метров плавает каждая вторая бабушка в бассейне.</p>
                <hr>
                <button class="btn btn-default btn-sm m-t-2" id="run">Бег</button>
                <button class="btn btn-secondary btn-sm m-t-2" id="swim">Плавание</button>
                <div class="row m-t-2" id="run-block">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-6">
                        <h4 class="m-b-1">Время и дистанция</h4>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <input class="form-control form-control-lg text-xs-center" type="text" maxlength="2" id="timeHour" placeholder="ЧЧ">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <input class="form-control form-control-lg text-xs-center" type="text" maxlength="2" id="timeMin" placeholder="ММ">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <input class="form-control form-control-lg text-xs-center" type="text" maxlength="2" id="timeSec" placeholder="СС">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                <div class="form-group">
                                    <input class="form-control form-control-lg" type="text" maxlength="5" min="30" max="200" id="distance" placeholder="Расстояние">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <div class="form-pace">метров</div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-lg m-b-2" id="calc">Рассчитать</button>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 resultRun hidden">
                        <div class="result">
                            <h4 class="m-b-1">Темп</h4>
                            <h1 class="ProximaNovaRegular"><span id="paceMin"></span>:<span id="paceSec"></span> на 1 км</h1>
                        </div>
                    </div>
                </div>
                <div class="row m-t-2 hidden" id="swim-block">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-6">
                        <h4 class="m-b-1">Время и дистанция</h4>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <input class="form-control form-control-lg text-xs-center" type="text" maxlength="2" id="timeHourSwim" placeholder="ЧЧ">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <input class="form-control form-control-lg text-xs-center" type="text" maxlength="2" id="timeMinSwim" placeholder="ММ">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <input class="form-control form-control-lg text-xs-center" type="text" maxlength="2" id="timeSecSwim" placeholder="СС">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                <div class="form-group">
                                    <input class="form-control form-control-lg" type="text" maxlength="5" min="30" max="200" id="distanceSwim" placeholder="Расстояние">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <div class="form-pace">метров</div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-lg m-b-2" id="calcSwim">Рассчитать</button>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 resultSwim hidden">
                        <div class="result">
                            <h4 class="m-b-1">Темп</h4>
                            <h1 class="ProximaNovaRegular"><span id="paceMinSwim"></span>:<span id="paceSecSwim"></span> на 100 м</h1>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="likely">
                    <div class="facebook">Поделиться</div>
                    <div class="twitter">Твитнуть</div>
                    <div class="vkontakte">Поделиться</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="ad-sidebar text-xs-center">
                <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
            </div>
        </div>
    </div>
</div>
