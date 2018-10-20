<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\SclikeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sc-like-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'test_id') ?>

    <?= $form->field($model, 'stu_id') ?>

    <?= $form->field($model, 'stu_name') ?>

    <?= $form->field($model, 'stu_class') ?>

    <?php // echo $form->field($model, 'stu_school') ?>

    <?php // echo $form->field($model, 'yw') ?>

    <?php // echo $form->field($model, 'ds') ?>

    <?php // echo $form->field($model, 'yy') ?>

    <?php // echo $form->field($model, 'wl') ?>

    <?php // echo $form->field($model, 'hx') ?>

    <?php // echo $form->field($model, 'sw') ?>

    <?php // echo $form->field($model, 'zf') ?>

    <?php // echo $form->field($model, 'mc') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
