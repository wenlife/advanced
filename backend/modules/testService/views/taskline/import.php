<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
$this->title = '导入指标';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="taskline-form">

<div class="box box-success">
<div class="box-header with-border">
  <h3 class="box-title">导入指标<small> (请做好excel表格后导入)</small></h3>
</div>
<!-- /.box-header -->
<div class="box-body">
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    
    <?= $form->field($model, 'var1')->dropDownList(CommonFunction::gradelist(),['prompt'=>'请选择年级'])->label('年级') ?>  
    <label><small>表格格式为： 班级/重本任务/重本目标/本科任务/本科指标/备注</small></label>
    <?= $form->field($model, 'file')->fileInput()->label('指标文件') ?>
    <button class="btn btn-primary">提交</button>
<?php ActiveForm::end() ?>

</div>

</div>



</div>