<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$val = ArrayHelper::map($items,'itemid','itemname');
$this->title = '主页栏目设置';
?>
<div class="body-content">

<?php $form = ActiveForm::begin(['options' => ['class' => 'form'],]); ?>
<div class="ccs">
  <div class="form-group">
    <label for="exampleInputEmail1">第一栏左侧（图片展示）</label>
    <?= $form->field($model, 'oneleft')->dropDownList(ArrayHelper::map($picturelists,'id','title'),['class'=>'form-control','prompt'=>'请选择第一栏内容']) ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">第一栏右侧</label>
    <p>通知栏</p>
  </div>
</div>
  <Hr>
<div class="ccs">
  <div class="form-group">
    <label for="exampleInputEmail1">第二栏左侧</label>
    <?= $form->field($model, 'twoleft')->dropDownList($val,['class'=>'form-control','prompt'=>'请选择第二栏内容']) ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">第二栏右侧</label>
     <?= $form->field($model, 'tworight')->dropDownList($val,['class'=>'form-control','prompt'=>'请选择第二栏内容']) ?>
  </div>
</div>
  <Hr>
<div class="ccs">
  <div class="form-group">
    <label for="exampleInputEmail1">第三栏图片列表</label>
    <?= $form->field($model, 'threeleft')->dropDownList(ArrayHelper::map($picturelists,'id','title'),['class'=>'form-control','prompt'=>'请选择第三栏内容']) ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">第四栏图片列表</label>
      <?= $form->field($model, 'threeright')->dropDownList(ArrayHelper::map($picturelists,'id','title'),['class'=>'form-control','prompt'=>'请选择第三栏内容']) ?>
  </div>
</div>
<button type="submit" class="btn btn-default">完成设置</button>
<?php ActiveForm::end(); ?>
</div>
<style type="text/css">
  .ccs{
    border:1px dashed #1df;
    padding:12px;
  }
</style>