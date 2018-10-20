
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\userDetail */
/* @var $form ActiveForm */
?>
<div class="site-detailForm">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'avatar') ?>
        <?= $form->field($model, 'msg') ?>
        <?= $form->field($model, 'info') ?>
        <?= $form->field($model, 'phone') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-detailForm -->
