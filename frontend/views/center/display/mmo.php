<?php
use yii\helpers\Html;
if (!isset($order)) {
	$order=4;
}
?>

<div class="well item">
<table class="table">

<tr class="" style="line-height: 20px;padding-bottom:10px"><td colspan=3><?=$model->content?></td></tr>
<tr><td colspan=3><strong>Note:</strong><?=$model->note?></td></tr>
<tr><td>来源：<?=$model->source?></td><td><?=$model->date?></td><td></td></tr>
</table>
</div>
<?php
//var_export($model->toArray());
	$options = $model->answer;//unserialize($model->options);
	$order = $order-3;
	if (!is_null($model->answer)) {
		foreach ($options as $key => $value) {
			echo $this->render($value->getViewName(),['model'=>$value,'order'=>$order++,'myAnswer'=>$myAnswer]);
		}
	}
	
?>
<style type="text/css">
.item p{padding:0px; margin:0px;display: inline;}
</style>
