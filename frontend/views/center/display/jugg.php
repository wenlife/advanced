<?php
if (!isset($order)) {
	$order=1;
}
$color = 'danger';
$font = "glyphicon glyphicon-remove";
if(array_key_exists($model->id, $myAnswer))
{
	$sanswer = $myAnswer[$model->id];

	if ($model->answer ==$sanswer) {
		$color = 'success';
		$font = "glyphicon glyphicon-ok";
	}
	//$answer = substr($sanswer,-1,1);
}else{
	$sanswer = "未选择";
}

?>
<div class="well" style="-moz-box-shadow:2px 2px 2px 3px green; -webkit-box-shadow:2px 2px 5px green; box-shadow:2px 2px 5px green;">
<table class="table">
<tr><td colspan=2 style="height:40px;padding:5px;">
	<div style="line-height:30px;border-bottom: 1px solid #ccc">【第<?=$order?>题.】<?=$model->content?></div></td>
	<td class="<?=$color?>" style="line-height: 30px;text-align: center">您的选择: <?=$sanswer?'正确':'错误';?> <span class="<?=$font?>"></span></td>
</tr>
<tr><td colspan=3 style="border-bottom:1px solid #ccc"><strong>分析: </strong><?=$model->note?></td></tr>
<tr><td>来源：<?=$model->source?></td><td>录入时间：<?=$model->date?></td><td></td></tr>
</table>
</div>