<?php
use yii\helpers\Html;
?>
<div class="item">
<p>
<B>
<?='第',$order,'题.【单选题】'?>
</B>
<?=$model->content?>
</p>

<div style="font-weight:normal">
<ul class="list-unstyled">
<?php
   foreach (unserialize($model->options) as $key => $choice) {
   	  echo "<li><label><input type='radio' name=$model->id value=$key>$choice</label><li>";
   }
?>
</ul>
</div>

<?php Html::radioList($model->id,null,unserialize($model->options),
[
	'style'=>"font-weight:normal",
	'template'=>'{label}{input}',
])?>
</div>
<style type="text/css">
	p{padding:0px; margin:0px;display: inline;}
</style>
