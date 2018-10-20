<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\modules\content\models\Infoitem;
/* @var $this yii\web\View */
/* @var $model common\models\content\Videolist */
/* @var $form yii\widgets\ActiveForm */
$infoItem  = new infoItem();
$list = $infoItem->find()->all();
?>

<div class="videolist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'cid')->textInput()->dropDownList(ArrayHelper::map($list,'itemid','itemname')) ?>

    <?= $form->field($model, 'iscollection')->dropDownList(['1'=>'合集','0'=>'单集']) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
