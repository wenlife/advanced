<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Testpaper */

$this->title = '创建试卷';
$this->params['breadcrumbs'][] = ['label' => 'Testpapers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$getCookie = Yii::$app->request->cookies;
$items = $getCookie->get("items");
if ($items) {
	$items = (array)$items;
    $items = $items["value"];
    //var_export($items);
    $single = array_key_exists(1,$items)?count($items[1]):0;
    $multi  = array_key_exists(2,$items)?count($items[2]):0;
    $jugg   = array_key_exists(3,$items)?count($items[3]):0;
    $mmo    = array_key_exists(4,$items)?count($items[4]):0;
}else{
    $items = array();
    
    $this->context->redirect(['item/itemlist']);
	exit('您还未选择试题！');
}
?>
<hr>
<div class="testpaper-create">
	<?php
	    $template1 = "<div class='input-group'><span class='input-group-addon'>{label}</span>{input}<span id='single' name='single' class='input-group-addon'>$single</span></div><span class=\"help-block\">{hint}</span>";
	    $template2 = "<div class='input-group'><span class='input-group-addon'>{label}</span>{input}<span id='multi' name='multi' class='input-group-addon'>$multi</span></div><span class=\"help-block\">{hint}</span>";
	    $template3 = "<div class='input-group'><span class='input-group-addon'>{label}</span>{input}<span id='jugg' name='jugg' class='input-group-addon'>$jugg</span></div><span class=\"help-block\">{hint}</span>";
	    $template4 = "<div class='input-group'><span class='input-group-addon'>{label}</span>{input}<span id='mmo' name='mmo' class='input-group-addon'>$mmo</span></div><span class=\"help-block\">{hint}</span>";
	?>

    <?php $form = ActiveForm::begin(); ?>
	    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'state')->dropDownList(['1'=>'启用','0'=>'不启用']) ?>
		<?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>   
	    <?= $form->field($model, 'singleChoiceScore',['template' => $template1])->textInput(['maxlength' => true,'class'=>'form-control sc']) ?>
		<?= $form->field($model, 'multiChoiceScore',['template' => $template2])->textInput(['maxlength' => true,'class'=>'form-control sc']) ?>
		<?= $form->field($model, 'JuggScore',['template' => $template3])->textInput(['maxlength' => true,'class'=>'form-control sc']) ?>
		<?= $form->field($model, 'MmoChoiceScore',['template' => $template4])->textInput(['maxlength' => true,'class'=>'form-control sc']) ?>
		<p>总分：<span id="zongfen"></span></p>
     <div class="form-group">      
        <?= Html::submitButton('Create', ['class' =>'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script type="text/javascript">

$(function(){
	//保存试题数量
	var score1 = $('#single').text();
	var score2 = $('#multi').text();
	var score3 = $('#jugg').text();
	var score4 = $('#mmo').text();
	//保存目前每种试题总分
	var s1 = 0;
	var s2 = 0;
	var s3 = 0;
	var s4 = 0;

	$(".sc").blur(function(){

		var sin = $(this).val();

		switch($(this).next('span').attr('id'))
		{

			case('single'):
			 	$(this).next('span').text(score1+"*"+sin);
			 	s1 = score1*sin;
			  	break;
		    case('multi'):
               	$(this).next('span').text(score2+"*"+sin);
               	//if(score2==0){$(this).hide();}
               	s2 = score2*sin;
			  	break;
		    case('jugg'):
				$(this).next('span').text(score3+"*"+sin);
				s3 = score3*sin;
			  	break;
		    case('mmo'):
				$(this).next('span').text(score4+"*"+sin);
				s4 = score4*sin;
			    break;
			default:
			    alert('出现未知试题！！');

		}

		$('#zongfen').text(s1+s2+s3+s4);
		
	})

	// $("#input1").blur(function(){
	// 	var sin = $("#input1").val();
	// 	$("#single").text(score1*sin);
	// });
	// $("#input2").blur(function(){
	// 	var sin = $("#input2").val();
	// 	$("#multi").text(score2*sin);
	// });
	// $("#input3").blur(function(){
	// 	var sin = $("#input3").val();
	// 	$("#jugg").text(score3*sin);
	// });
	// $("#input4").blur(function(){
	// 	var sin = $("#input4").val();
	// 	$("#mmo").text(score4*sin);
	// });

});

</script>

