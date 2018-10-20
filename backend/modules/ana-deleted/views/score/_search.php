<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ana\models\AnascoreSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ana-score-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'stu_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'exam_id') ?>

    <?= $form->field($model, 'yw') ?>

    <?php // echo $form->field($model, 'ds') ?>

    <?php // echo $form->field($model, 'yy') ?>

    <?php // echo $form->field($model, 'wl') ?>

    <?php // echo $form->field($model, 'hx') ?>

    <?php // echo $form->field($model, 'sw') ?>

    <?php // echo $form->field($model, 'zz') ?>

    <?php // echo $form->field($model, 'ls') ?>

    <?php // echo $form->field($model, 'dl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
