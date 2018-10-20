<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\PicturelistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picturelist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'note') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'is_collection') ?>

    <?php // echo $form->field($model, 'kewords') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'cover') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
