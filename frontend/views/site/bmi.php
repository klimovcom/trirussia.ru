<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 6/13/16
 * Time: 9:36 AM
 */
?>

<div class="container">
    <h1 class="m-t-3 m-b-3">Калькулятор BMI (индекс массы тела)</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card card-block">
                <p>Индекс массы тела (по английски: body mass index (BMI)) — это величина, позволяющая дать объективную оценку соответствия веса человека и его роста. В зависимости от результатов можно сказать, насколько это значение вписывается в норму. Индекс массы тела широко используется в диетологии и при планировании тренировочного процесса.</p>
                <div class="row m-t-3 m-b-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <form>
                            <fieldset class="form-group">
                                <input class="form-control form-control-lg" type="text" maxlength="3" min="30" max="200" id="weight" placeholder="Введите ваш вес в кг" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <input class="form-control form-control-lg" type="text" maxlength="3" min="130" max="220" id="height" placeholder="Введите ваш рост в см" required>
                            </fieldset>
                            <div class="pull-left">
                                <button type="button" class="btn btn-primary btn-lg" id="calc">Узнать</button>
                            </div>
                            <div class="pull-right">
                                <div class="bmi-result-mobile hidden-md-up"></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 hidden-sm-down">
                        <div class="result">
                            <h4>Ваш результат:</h4>
                            <h1 class="bmi-result"></h1>
                        </div>
                    </div>
                </div>
                <div class="hidden" id="bmi-comment">
                    <hr>
                    <h3 class="m-t-3 m-b-2">Интерпретация данных</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Значение</th>
                            <th>Комментарий</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>16 и менее</td>
                            <td>Выраженный дефицит массы тела</td>
                        </tr>
                        <tr>
                            <td>16 — 18,5</td>
                            <td>Недостаточная (дефицит) масса тела</td>
                        </tr>
                        <tr>
                            <td>18,5 — 25</td>
                            <td>Норма</td>
                        </tr>
                        <tr>
                            <td>25 — 30</td>
                            <td>Избыточная масса тела (предожирение)</td>
                        </tr>
                        <tr>
                            <td>30 — 35</td>
                            <td>Ожирение первой степени</td>
                        </tr>
                        <tr>
                            <td>35 — 40</td>
                            <td>Ожирение второй степени</td>
                        </tr>
                        <tr>
                            <td>40 и более</td>
                            <td>Ожирение третьей степени (морбидное)</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="likely">
                        <div class="facebook">Поделиться</div>
                        <div class="twitter">Твитнуть</div>
                        <div class="vkontakte">Поделиться</div>
                    </div>
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
