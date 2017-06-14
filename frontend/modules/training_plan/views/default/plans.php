<?php
foreach ($models as $model) {
    echo $this->render('card', [
        'model' => $model,
        'cardClass' => 'col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4',
    ]);
}
