<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\infoitemsearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="infoitem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'itemid') ?>

    <?= $form->field($model, 'parentid') ?>

    <?= $form->field($model, 'itemname') ?>

    <?= $form->field($model, 'itemurl') ?>

    <?= $form->field($model, 'itemtype') ?>

    <?php // echo $form->field($model, 'itemdesc') ?>

    <?php // echo $form->field($model, 'itemorder') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
