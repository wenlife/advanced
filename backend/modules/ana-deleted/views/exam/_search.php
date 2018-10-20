<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ana\models\AnaexamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ana-exam-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'grade') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'compare') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
