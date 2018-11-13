<?php
$choiceArr = ['A','B','C','D'];
if (!isset($order)) {
	$order=1;
}
$color = 'danger';
$font = "glyphicon glyphicon-remove";

if(array_key_exists($model->id,$myAnswer))
{
	//$sanswer = $myAnswer[$model->id];
	if ($model->answer ==$myAnswer[$model->id]) {
		$color = 'success';
		$font = "glyphicon glyphicon-ok";
		$answer = substr($myAnswer[$model->id],-1,1);
	}else{
        $answer = substr($myAnswer[$model->id],-1,1)." 正确答案:".substr($model->answer,-1,1);
	}
	
}else{
	$answer = "未选择";
}


?>
<div class="well item" style="-moz-box-shadow:2px 2px 2px 3px green; -webkit-box-shadow:2px 2px 5px green; box-shadow:2px 2px 5px green;">
<?php
?>
<table class="table">
<tr><td colspan=2 style="height:40px;padding:5px;"><div style="line-height:30px;border-bottom: 1px solid #ccc">【第<?=$order?>题】. <?=$model->content?></div></td>
	<td class=<?=$color?> style="line-height: 30px;text-align: center">您的选择: <?=$answer ?> <span class="<?=$font?>"></span></td>
</tr>
<?php
foreach ($choiceArr as $key => $value) {
	$option = 'option'.$value;
	echo '<tr style="text-indent:20px" ><td colspan=3 style="border:0">'.$value.'.  ';
	echo $model->$option;
	echo "</td></tr>";
}
?>
<tr><td colspan=3 style="border-bottom:1px solid #ccc"><strong>分析: </strong><?=$model->note?></td></tr>
<tr><td>来源：<?=$model->source?></td><td>录入时间：<?=$model->date?></td><td></td></tr>
</table>
</div>

<style type="text/css">
.item p{padding:0px; margin:0px;display: inline;}
.item .glyphicon-ok{
    	color:green;
        font-size:15px;
    }
.item .glyphicon-remove{
    	color:red;
    }
</style>
<?php
//exit();
?>