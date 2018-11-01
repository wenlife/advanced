<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\TasklineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taskline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'grade') ?>

    <?= $form->field($model, 'banji') ?>

    <?= $form->field($model, 'line1') ?>

    <?= $form->field($model, 'line2') ?>

    <?php // echo $form->field($model, 'line3') ?>

    <?php // echo $form->field($model, 'line4') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
