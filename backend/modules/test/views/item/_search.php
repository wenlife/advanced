<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\TestitemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'alone') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'options') ?>

    <?php // echo $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'chapter') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <?php // echo $form->field($model, 'wrong') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
