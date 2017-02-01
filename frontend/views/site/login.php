<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <h1 class="m-t-3 m-b-3">Войдите на сайт</h1>
            <p>Для того, чтобы в полной мере использовать функционал сервиса, вам необходимо зарегистрироваться. Для этого просто кликните по кнопке ниже:</p>
            <?= \frontend\widgets\auth\Auth::widget([
                'baseAuthUrl' => ['/site/auth']
            ]) ?>
        </div>
    </div>
</div>