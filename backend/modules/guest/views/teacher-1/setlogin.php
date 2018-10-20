<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserTeacher */

$this->title = 'Update User Teacher: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'User Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secode')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Update', ['class' =>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>