<?php
/**
 * @var $options array
 */
foreach($options as $option){
   print '<option value="'.$option->id.'">'.$option->label.'</option>';
}
?>

