<?php
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
$this->title = '班级对应设置';
//var_export($compare);
//exit();
?>
<div class="testService-default-index">
<hr>
<div class="row">
 <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]); ?>
 <div class='form-group'>
   
 <?php
    echo " <div class='form-group'><label class='col-sm-1 control-label'>学校</label><div class='col-sm-10'>";
    echo Html::dropDownList('school',null,['市七中'=>'市七中'],['class'=>'form-control']);
      echo " </div></div>";
    foreach ($bj as $key => $value) {

    	echo " <div class='form-group'><label class='col-sm-1 control-label'>$value</label><div class='col-sm-10'>";
      // echo $key.'+'.$value.'=---';
    	echo Html::dropDownList($key,$key+1,ArrayHelper::map($classes,'id','title'),['class'=>'form-control']);
    	echo " </div></div>";
    }
 ?>

  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-10">
      <button type="submit" class="btn btn-primary">确定</button>
    </div>
  </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
