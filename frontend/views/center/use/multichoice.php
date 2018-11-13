<?php
use yii\helpers\Html;
?>
<div class="item">
<p>
<B>
<?='第',$order,'题.【多选题】'?>
</B>
<?=$model->content?>
</p>
<div style="font-weight:normal">
<ul class="list-unstyled">
<?php
   foreach (unserialize($model->options) as $key => $choice) {
   	  echo "<li><label><input type='checkbox' name=$model->id[] value=$key>$choice</label></li>";
   }
?>
</ul>
</div>

<?php Html::checkBoxList($model->id,null,unserialize($model->options))?>
</div>

<style type="text/css">
.item p{padding:0px; margin:0px;display: inline;}
.item ul{
		margin-top: 10px;
	}
</style>