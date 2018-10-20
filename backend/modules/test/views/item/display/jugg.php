<?php
if (!isset($order)) {
	$order=1;
}
?>
<div class="well" style="-moz-box-shadow:2px 2px 2px 3px green; -webkit-box-shadow:2px 2px 5px green; box-shadow:2px 2px 5px green;">
<table class="table">
<tr><td colspan=2 style="height:40px;padding:5px;"><div style="line-height:30px;border-bottom: 1px solid #ccc">【第<?=$order?>题.】<?=$model->content?></div></td>
	<td class="success" style="line-height: 30px;text-align: center">正确答案: <?=$model->answer?'正确':'错误';?></td>
</tr>
<tr><td colspan=3 style="border-bottom:1px solid #ccc"><strong>分析: </strong><?=$model->note?></td></tr>
<tr><td>来源：<?=$model->source?></td><td>录入时间：<?=$model->date?></td><td></td></tr>
</table>
</div>