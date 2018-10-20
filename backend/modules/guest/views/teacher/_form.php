<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
$subjects = CommonFunction::getSubjects();
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
     <?= $form->field($model, 'pinx')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->dropDownList($subjects,['prompt'=>'请选择任教科目']) ?>

    <?= $form->field($model, 'type')->dropDownList(CommonFunction::getTeacherType()) ?>

    <?= $form->field($model, 'graduate')->dropDownList(CommonFunction::getSchool()) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
