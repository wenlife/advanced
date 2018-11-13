<?php
use yii\helpers\Html;
?>
<div class="item">
<p>
<B>
<?='第',$order,'题.【判断题】'?>
</B>
<?=$model->content?>
</p>
<?=Html::radioList($model->id,null,['1'=>'正确','0'=>'错误'],['style'=>"font-weight:normal"])?>
</div>