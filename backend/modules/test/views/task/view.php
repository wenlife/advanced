<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-md-6">
 <div class="box box-info">
    <div class="box-header">
<div class="task-view">
<?php $form = ActiveForm::begin(['id' => 'form','method'=>'post','options'=>['class'=>"form-inline"]]); ?>  
<div class="form-group">
<?=Html::dropDownList('class',$class,ArrayHelper::Map($classes,'id','title'),['class'=>'form-control'])?>
</div>
<button type="submit" class="btn btn-info">提交</button>
<?php ActiveForm::end(); ?>   
    </div>
    <div class="box-body">
<table class="table table-bordered">
<tr><th>id</th><th>姓名</th><th>成绩</th></tr>
<?php
    foreach ($students as $key => $student) {
       echo "<tr><td>";
       echo $student->username;
       echo "</td><td>";
       echo $student->name;
       echo "</td><td>";
       echo $scores[$student->username];
       echo "</td></tr>";
    }
?>
</table>
    </div>
    <div class="box-footer clearfix">
      
    </div>
  </div>
</div>
</div>
</div>
