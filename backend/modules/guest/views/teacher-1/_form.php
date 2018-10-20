<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserTeacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->dropDownList(Yii::$app->params['subject'],['prompt'=>'请选择任教科目'])?>

    <?= $form->field($model, 'gender')->dropDownList(['1'=>'男','2'=>'女'],['prompt'=>'请选择性别']) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
