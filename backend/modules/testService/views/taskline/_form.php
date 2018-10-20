<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\Taskline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taskline-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line1')->textInput() ?>

    <?= $form->field($model, 'line2')->textInput() ?>

    <?= $form->field($model, 'line3')->textInput() ?>

    <?= $form->field($model, 'line4')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
