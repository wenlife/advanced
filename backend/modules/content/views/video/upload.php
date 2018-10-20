<?php
use yii\widgets\ActiveForm;
$this->title = '上传视频'
?>

<div class="box box-widget">
            <div class="box-header with-border">

              <!-- /.user-block -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    
	<?php // $form->field($model, 'infoid')->textInput() ?>
    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attachdesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'showorder')->textInput() ?>

    <button>提交</button>

<?php ActiveForm::end() ?>

</div>
</div>