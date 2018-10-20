<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

$subjects = CommonFunction::getSubjects();
$subjects['bzr'] = '班主任';

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachManage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teach-manage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'year_id')->dropDownList($model->years,['prompt'=>'请选择任教学年']) ?>

    <?= $form->field($model, 'class_id')->dropDownList($model->teachclasses,['prompt'=>'请选择班级']) ?>

    <?= $form->field($model, 'subject')->dropDownList($subjects,['prompt'=>'请选择科目']) ?>

    <?= $form->field($model, 'teacher_id')->dropDownList($model->teachers,['prompt'=>'请选择教师']) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
