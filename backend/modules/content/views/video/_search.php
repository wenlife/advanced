<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'attachid') ?>

    <?= $form->field($model, 'infoid') ?>

    <?= $form->field($model, 'gbid') ?>

    <?= $form->field($model, 'attachdesc') ?>

    <?= $form->field($model, 'showorder') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'expand_name') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'filestatus') ?>

    <?php // echo $form->field($model, 'isdl') ?>

    <?php // echo $form->field($model, 'releaser') ?>

    <?php // echo $form->field($model, 'release_date') ?>

    <?php // echo $form->field($model, 'deletedate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
