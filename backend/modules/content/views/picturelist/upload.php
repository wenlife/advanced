<?php
use yii\widgets\ActiveForm;
$this->title = '上传图片';
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attachdesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'showorder')->textInput() ?>

 

    <button>Submit</button>

<?php ActiveForm::end() ?>