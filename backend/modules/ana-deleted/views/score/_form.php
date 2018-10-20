<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ana\models\AnaScore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ana-score-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stu_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_id')->textInput() ?>

    <?= $form->field($model, 'yw')->textInput() ?>

    <?= $form->field($model, 'ds')->textInput() ?>

    <?= $form->field($model, 'yy')->textInput() ?>

    <?= $form->field($model, 'wl')->textInput() ?>

    <?= $form->field($model, 'hx')->textInput() ?>

    <?= $form->field($model, 'sw')->textInput() ?>

    <?= $form->field($model, 'zz')->textInput() ?>

    <?= $form->field($model, 'ls')->textInput() ?>

    <?= $form->field($model, 'dl')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
