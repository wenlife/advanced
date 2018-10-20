<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachManage */
$teachers = $teachmod->getTeachersGroupBySubject();
//var_export($teachers);
//exit();

$this->title = '任教管理';
$this->params['breadcrumbs'][] = ['label' => 'Teach Manages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-manage-create">
<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">添加班级任教</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
  <div class="teach-manage-form">
  <div class="row">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4">
    <?= $form->field($model, 'grade')->dropDownList($teachmod->years,['prompt'=>'请选择任教学年']) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'banji')->dropDownList($teachmod->teachclasses,['prompt'=>'请选择班级']) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'bzr')->dropDownList($teachmod->teachers,['prompt'=>'请选择教师']) ?>
    </div>
   

   
    <div class="col-md-4">
    <?= $form->field($model, 'yw')->dropDownList($teachers['yw'],['prompt'=>'请选择教师']) ?>
    </div>
   <div class="col-md-4">
   	<?= $form->field($model, 'ds')->dropDownList($teachers['ds'],['prompt'=>'请选择教师']) ?>
   	</div>
    <div class="col-md-4">
    	<?= $form->field($model, 'yy')->dropDownList($teachers['yy'],['prompt'=>'请选择教师']) ?>
    </div>
    <div class="col-md-4">
    	<?= $form->field($model, 'wl')->dropDownList($teachers['wl'],['prompt'=>'请选择教师']) ?>
    </div>
    <div class="col-md-4">
    	<?= $form->field($model, 'hx')->dropDownList($teachers['hx'],['prompt'=>'请选择教师']) ?>
    </div>
    <div class="col-md-4">
    	<?= $form->field($model, 'sw')->dropDownList($teachers['sw'],['prompt'=>'请选择教师']) ?>
    </div>
    <div class="col-md-4">
    	<?= $form->field($model, 'zz')->dropDownList($teachers['zz'],['prompt'=>'请选择教师']) ?>
    </div>
    <div class="col-md-4">
    	 <?= $form->field($model, 'ls')->dropDownList($teachers['ls'],['prompt'=>'请选择教师']) ?>
    </div>
    <div class="col-md-4">
    	 <?= $form->field($model, 'dl')->dropDownList($teachers['dl'],['prompt'=>'请选择教师']) ?>
    </div>
    <div class="form-group col-md-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>
