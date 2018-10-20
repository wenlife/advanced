<?php
$choiceArr = ['A','B','C','D'];
if (!isset($order)) {
	$order=1;
}
$rig = null;
foreach ($model->answer as $key => $value) {
	$rig .= substr($value,-1,1).' ';
}
?>
<div class="well" style="-moz-box-shadow:2px 2px 2px 3px green; -webkit-box-shadow:2px 2px 5px green; box-shadow:2px 2px 5px green;">
<table class="table table-bordered">
<tr><td colspan=2 style="height:40px;padding:5px;"><div style="line-height:30px;border-bottom: 1px solid #ccc">【第<?=$order?>题】.<?=$model->content?></div></td>
	<td class="success" style="line-height: 30px;text-align: center">正确答案: <?=$rig ?></td>
</tr>
<?php
foreach ($choiceArr as $key => $value) {
	$option = 'option'.$value;
	echo '<tr style="text-indent:20px" ><td colspan=3>'.$value.'.  ';
	echo $model->$option;
	echo "</td></tr>";
}
?>
<tr><td colspan=3 style="border-bottom:1px solid #ccc"><strong>分析: </strong><?=$model->note?></td></tr>
<tr><td>来源：<?=$model->source?></td><td>录入时间：<?=$model->date?></td><td></td></tr>
</table>
</div>
<style type="text/css">
	p{padding:0px; margin:0px;display: inline;}
</style>
