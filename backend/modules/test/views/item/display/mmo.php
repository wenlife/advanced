<?php
use yii\helpers\Html;
use yii\helpers\Url;
if (!isset($order)) {
	$order=4;
}?>

<div class="well">
<table class="table">

<tr class="" style="line-height: 20px;padding-bottom:10px"><td colspan=3><?=$model->content?></td></tr>
<tr>
<td colspan="3"><?=Html::a('添加单选题',['addsub','id'=>$model->id,'type'=>1,],['class'=>'btn btn-success'])?>
    <?=Html::a('添加多选题',['addsub','id'=>$model->id,'type'=>2],['class'=>'btn btn-success'])?>
    <?=Html::a('添加判断题',['addsub','id'=>$model->id,'type'=>3],['class'=>'btn btn-success'])?>
</td>
</tr>
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
			echo "<a href=".Url::toRoute(['update','id'=>$value->id]).">修改此题</a>";
			echo $this->render($value->getViewName(),['model'=>$value,'order'=>$order++]);
		}
	}
	
?>
<style type="text/css">
	p{padding:0px; margin:0px;display: inline;}
</style>
