<?php
use yii\helpers\Html;
?>

<div class="row">
<table class="table" style="border:1px solid #ccc">
<tr class="" style="line-height: 20px;padding-bottom:10px"><td colspan=3><?=$model->content?></td></tr>
<tr><td colspan=3><strong>Note:</strong><?=$model->note?></td></tr>
<tr><td>来源：<?=$model->source?></td><td><?=$model->date?></td><td><?=$model->date?></td></tr>
</table>
</div>
<?php
//var_export($model->toArray());
	$options = $model->answer;//unserialize($model->options);
	if (!is_null($model->answer)) {
		foreach ($options as $key => $value) {
			echo $this->render($value->getViewName(),['model'=>$value,'givenAnswer'=>$givenAnswer[$value->id]]);
		}
	}
	
?>
