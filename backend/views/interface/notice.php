<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$this->title = '通知消息设置';
?>
<div class="body-content">
<?php $form = ActiveForm::begin(['options' => ['class' => 'form'],]); ?>
<div class="form-group">
    <?php //Html::textarea('notice',$notice,['rows'=>20,'cols'=>'150','id'=>'text1']);?>
    <?=\kucha\ueditor\UEditor::widget(['id'=>'notice','name'=>'notice','value'=>$notice])?>
  </div>
<button type="submit" class="btn btn-default">提交设置</button>
<?php ActiveForm::end(); ?>
</div>




