<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 5/21/16
 * Time: 8:29 PM
 * @var $options array
 */
?>
<option value="">Выберите дистанцию</option>
<?php foreach ($options as $id => $option){ ?>
    <option value="<?= $id; ?>"><?= $option; ?></option>
<?php } ?>
