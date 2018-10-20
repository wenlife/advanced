<?php  
use yii\widgets\Pjax;  
use yii\helpers\Html;
?>
<?php Pjax::begin(['id'=>"111"])?>  
<div id="111"></div>
<?=Html::a('time',['setcookie'],['class'=>'btn btn-lg btn-primary','data-pjax'=>'con'])?>  
<h3>Current Time:<?=$time?></h3>  
<?php Pjax::end()?>


