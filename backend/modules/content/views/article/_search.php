<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\content\InformationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="information-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'infoid') ?>

    <?= $form->field($model, 'infoitem') ?>

    <?= $form->field($model, 'headline') ?>

    <?= $form->field($model, 'subhead') ?>

    <?= $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'publish_date') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'abstract') ?>

    <?php // echo $form->field($model, 'ishow') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'releaser') ?>

    <?php // echo $form->field($model, 'release_date') ?>

    <?php // echo $form->field($model, 'headcolor') ?>

    <?php // echo $form->field($model, 'subhcolor') ?>

    <?php // echo $form->field($model, 'iscomment') ?>

    <?php // echo $form->field($model, 'isdelete') ?>

    <?php // echo $form->field($model, 'deletedate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
