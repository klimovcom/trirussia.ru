<a href="<?= $race->getViewUrl();?>">
    <div class="race-vote-gradient">
        <div class="row">
            <div class="col-xl-8">
                <h3>Были на <?= $race->label;?>?</h3>
                <h3 class="PTSerif m-a-0"><i>Понравилось? — Скажите!</i></h3>
            </div>
            <div class="col-xl-4 text-xs-right">
                <h2 class="m-a-0">
                    <i class="fa fa-star gold" aria-hidden="true"></i>
                    <?= $race->rating ? number_format(round($race->rating, 2), 2, '.', '') : '';?>
                </h2>
            </div>
        </div>
    </div>
</a>