<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$this->title = 'use';
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//==============canshu================================
$getCookie = Yii::$app->request->cookies;
$items = $getCookie->get("items");
if ($items) {
	$items = (array)$items;
    $items = $items["value"];
    //var_export($items);
}else{
	$items = array();
	//echo 'null';
}

function itemCount($key,$arr)
{
	if(array_key_exists($key, $arr))
	{ 
		return count($arr[$key]);
	}else{
		return '0';
	}
}
?>

<div class="row">
<div class="col-sm-3">
<div class="con" style="position: fixed">
	<table class="table table-bordered">
		<tr><th>试题类型</th><th>试题数量</th></tr>
		<tr><td>单选题</td><td id="danx"><?=itemCount(1,$items)?></td></tr>
		<tr><td>多选题</td><td id="duox"><?=itemCount(2,$items)?></td></tr>
		<tr><td>判断题</td><td id="pand"><?=itemCount(3,$items)?></td></tr>
		<tr><td>综合题</td><td id="zongh"><?=itemCount(4,$items)?></td></tr>
		<tr><td colspan=2>
		<a href="index.php?r=test/testpaper/create" class="btn btn-primary">生成预览</a>
		<a href="index.php?r=test/item/resetcookie" class="btn btn-danger pull-right">清除选择</a>
		</td></tr>
	</table>
</div>
	 
</div>
<div class="col-sm-9">
<div class="well">
	<?php $form = ActiveForm::begin(['method'=>'post','options'=>['class'=>'form-inline']]); ?>
	  <div class="form-group">
	    <label class="sr-only" for="exampleInputEmail3">Email address</label>
	    <?=Html::dropDownList('type',$type,$typeName,['prompt' => '请选择题目类型','class'=>'form-control','style'=>'width:150px']);?>
	  </div>

	  <div class="form-group">
	    <label class="sr-only" for="exampleInputPassword3">Password</label>
	     <?=Html::dropDownList('chapter',$chapter,ArrayHelper::map($chapters,'id','name'),['prompt' => '请选择题目章节','class'=>'form-control','style'=>'width:150px']);?>
	  </div>
	 
	  <button type="submit" class="btn btn-success">submit</button>
	<?php ActiveForm::end(); ?>
</div>
<?php
if(is_array($model))
{
	$order = 1;
	foreach ($model as $key=>$value) {
		if ($value->getViewName()=='mmo') {
			$order = $order+3;
		}
?>
<div class="well">
<div class="row">
<div class="col-sm-10 item-border">
<?=$this->render('use/'.$value->getViewName(),['order'=>$order++,'model'=>$value]);?>
</div>
<div class="col-sm-2">
<p>难度：<?php echo $value->sum==null?'--':round($value->wrong/$value->sum,2)?></p>
<?php 
$title = "选用";
$btn = "btn-primary";
$dis = "";
if (array_key_exists($value->type,$items)) {
	if (in_array($value->id,$items[$value->type])) {
		$title = "已选";
		$btn = "btn-success";
		$dis = "disabled";
	}
}
?> 
<input type="button" value="<?=$title?>" class="btn <?=$btn?> btn-small choose" name="<?php echo $value->type.':'.$value->id?>" <?=$dis?> >
</div>
</div>
</div>
<?php
	}
}
?>
</div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(function(){
	$("input.choose").click(function(){
		input = $(this);			
		$.ajax({
                url: "index.php?r=test/item/setcookie",
                type: "get",
                dataType:"json",
                cache:false,
                data: {cookie:this.name},
                success: function (data) {
                	//alert('success');
                	input.val("已选").removeClass('btn-primary').addClass("btn-success").attr("disabled","disabled");
                	$.each(data,function(n,value){
                		switch(n)
                		{
                			case("1"):
                				$("#danx").text(value.length);
                				break;
                			case("2"):
                				$("#duox").text(value.length);
                				break;
                			case("3"):
                				$("#pand").text(value.length);
                				break;
                			case("4"):
                				$("#zongh").text(value.length);
                				break;
                			default:
                				alert('Item type does not exist!'); 
                		}

                	});

                }
        });
	});

})
</script>
<style type="text/css">
label{
	font-weight: normal;
	width:100%;
	text-indent: 20px;
}
label>input{
	margin-right: 20px;
	width:30px;
}

.item-border{
	border-right:1px solid #ccc;
}
</style>

