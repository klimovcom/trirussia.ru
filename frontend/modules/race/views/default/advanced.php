<div class="container">
    <h1 class="m-t-3 m-b-3">Поздравляем!</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card card-block">
                <h4>Вы успешно добавили соревнование</h4>
                <p>Теперь тысячи людей увидят его в нашем календаре и смогут спланировать свой соревновательный план. Но и это ещё не всё. Мы предлагаем вам увеличить охват и выделиться среди множества других соревнований, подключив расширенные возможности.</p>
                <div class="add-advanced">
                    <button class="btn btn-secondary" data-toggle="collapse" data-target="#advanced-description" aria-expanded="false">Расширенные возможности</button> — всего 1000 рублей
                    <div class="collapse" id="advanced-description">
                        <p class="card-text PTSerif lead m-t-2"><i>Если вы хотите привлечь больше участников на ваше соревнование, подключите расширенный пакет. В него входят:</i></p>
                        <div class="row m-t-2">
                            <div class="col-md-4 col-lg-4 col-lg-4">
                                <strong>Картинка соревнования на главной странице</strong>
                            </div>
                            <div class="col-md-8 col-lg-8 col-lg-8">
                                На <a href="/" class="underline" target="_blank">главной странице сайта</a> карточка соревнования показывается с картинкой.
                            </div>
                        </div>
                        <div class="row m-t-1">
                            <div class="col-md-4 col-lg-4 col-lg-4">
                                <strong>1 000 показов баннера</strong>
                            </div>
                            <div class="col-md-8 col-lg-8 col-lg-8">
                                Бесплатное изготовление баннера 300х600 и 1 000 показов баннера на сайте.
                            </div>
                        </div>
                        <div class="row m-t-1">
                            <div class="col-md-4 col-lg-4 col-lg-4">
                                <strong>Подробное описание</strong>
                            </div>
                            <div class="col-md-8 col-lg-8 col-lg-8">
                                Разместите на странице схему трасс, положение, расписание соревновательного дня и логотипы спонсоров.
                            </div>
                        </div>
                        <div class="row m-t-1">
                            <div class="col-md-4 col-lg-4 col-lg-4">
                                <strong>Анонс в Фейсбуке</strong>
                            </div>
                            <div class="col-md-8 col-lg-8 col-lg-8">
                                Анонс соревнования в Фейсбуке.
                            </div>
                        </div>
                        <hr>
                        <div class="row m-t-1">
                            <div class="col-md-4 col-lg-4 col-lg-4">
                                <h1>1000 ₽</h1>
                            </div>
                            <div class="col-md-8 col-lg-8 col-lg-8">
                                Стоимость расширенного пакета. Действует с момента оплаты до даты соревнования.
                            </div>
                        </div>
                        <p class="card-text PTSerif lead m-t-3"><i>Дополнительно:</i></p>
                        <div class="row m-t-2">
                            <div class="col-md-4 col-lg-4 col-lg-4">
                                <h3>3000 ₽</h3>
                            </div>
                            <div class="col-md-8 col-lg-8 col-lg-8">
                                Выделение соревнования на главной странице и на <a href="/races.php" class="underline">страницах видов спорта</a>. Это самый популярный у пользователей формат.
                            </div>
                        </div>
                        <div class="row m-t-1">
                            <div class="col-md-4 col-lg-4 col-lg-4">
                                <h3>5000 ₽</h3>
                            </div>
                            <div class="col-md-8 col-lg-8 col-lg-8">
                                Единоразовая email-рассылка с анонсом вашего соревнования. Письмо верстается в нашем формате.
                            </div>
                        </div>
                        <div class="row m-t-1">
                            <div class="col-md-4 col-lg-4 col-lg-4">
                                <h3>Бесплатно</h3>
                            </div>
                            <div class="col-md-8 col-lg-8 col-lg-8">
                                5 000 показов баннера при покупке любой дополнительной опции.
                            </div>
                        </div>
                        <div class=" m-t-3">

                            <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-t-2 m-b-2">
                                        <div class="payment-form">

                                            <fieldset class="form-group">
                                                <label>Выберите способ оплаты</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="paymentType" checked value="AC">&nbsp;&nbsp;Банковской картой
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="paymentType" value="PC">&nbsp;&nbsp;Через Яндекс.Кошелек
                                                    </label>
                                                </div>
                                            </fieldset>

                                            <fieldset class="form-group">
                                                <label>Выберите сумму оплаты</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sum" checked value="1000"> 1000 ₽
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sum" value="3000"> 3000 ₽
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sum" value="5000"> 5000 ₽
                                                    </label>
                                                </div>
                                            </fieldset>

                                            <input type="hidden" name="receiver" value="<?= $yandexMoney;?>">
                                            <input type="hidden" name="quickpay-form" value="shop">
                                            <input type="hidden" name="formcomment" value="Trirussia.ru, оплата гонки: <?= $race->label?>">
                                            <input type="hidden" name="short-dest" value="Trirussia.ru, оплата гонки: <?= $race->label?>">
                                            <input type="hidden" name="label" value="<?= $race->label;?>">
                                            <input type="hidden" name="targets" value="Trirussia.ru, оплата гонки: <?= $race->label?>">

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-t-2 m-b-2">
                                        <h5>Безопасно</h5>
                                        <p>Платеж совершается на сайте лучшей эквайринговой системы в России — Яндекс.Денег. Мы не знаем и не храним данные вашей карты.</p>
                                        <h5>Без комиссии</h5>
                                        <p>Все комиссионные затраты мы берем на себя. С вашего счета спишется столько денег, сколько указано в платежной форме.</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <button type="submit" class="btn btn-danger btn-lg">Оплатить</button><span class="m-l-2 text-muted">После клика вы будете перенаправлены на сайт Яндекс.Денег</span>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>