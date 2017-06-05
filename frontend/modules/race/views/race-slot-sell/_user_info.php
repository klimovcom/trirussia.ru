<p>Обратите внимание, что не все организаторы разрешают покупать слоты у других участников. Более того, многие запрещают это делать, поэтому обязательно ознакомьтесь с правилами организатора соревнований.</p>
<div class="register">
    <h5 class="m-b-2">Контактные данные</h5>
    <ul class="list-unstyled">
        <li><strong><?= $offer->user->last_name . ' ' . $offer->user->first_name;?></strong></li>
        <li><?= $offer->user->email;?></li>
        <li>Слот на <?= \yii\helpers\Html::a($offer->race->label, ['/race/default/view', 'url' => $offer->race->url], ['class' => 'underline']);?> за <?= $offer->price;?></li>
    </ul>
</div>
			