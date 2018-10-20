<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\ScWenke */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sc-wenke-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'test_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stu_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stu_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stu_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stu_school')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yw')->textInput() ?>

    <?= $form->field($model, 'ds')->textInput() ?>

    <?= $form->field($model, 'yy')->textInput() ?>

    <?= $form->field($model, 'zz')->textInput() ?>

    <?= $form->field($model, 'ls')->textInput() ?>

    <?= $form->field($model, 'dl')->textInput() ?>

    <?= $form->field($model, 'zf')->textInput() ?>

    <?= $form->field($model, 'mc')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
