<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Picturelist */
/* @var $form yii\widgets\ActiveForm */
use backend\modules\content\models\Infoitem;
$infoItem  = new infoItem();
$list = $infoItem->find()->all();
?>
<div class="picturelist-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'cid')->dropDownList(ArrayHelper::map($list,'itemid','itemname')) ?>

    <?= $form->field($model, 'is_collection')->dropDownList(['1'=>'合集','2'=>'单集']) ?>

    <?= $form->field($model, 'kewords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cover')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
