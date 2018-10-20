<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\TestscoreSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-score-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'testid') ?>

    <?= $form->field($model, 'answer') ?>

    <?= $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'backup') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
