<div class="container">
    <div class="row m-t-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card card-block">
                <h1 class="text-xs-center m-t-2 m-b-3">Оплата</h1>
                <hr>
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
                                <input type="hidden" name="receiver" value="<?= $yandexMoney;?>">
                                <input type="hidden" name="quickpay-form" value="shop">
                                <input type="hidden" name="sum" value="<?= $model->cost;?>">
                                <input type="hidden" name="formcomment" value="Trirussia.ru, Заказ №<?= $model->label;?>">
                                <input type="hidden" name="short-dest" value="Trirussia.ru, Заказ №<?= $model->label;?>">
                                <input type="hidden" name="label " value="<?= $model->label;?>">
                                <input type="hidden" name="targets" value="<?= $model->getOrderPositionsString();?>">

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
                            <button type="submit" class="btn btn-danger btn-lg">Оплатить <?= $model->cost;?> ₽</button><span class="m-l-2 text-muted">После клика вы будете перенаправлены на сайт Яндекс.Денег</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
