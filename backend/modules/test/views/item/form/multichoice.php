<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\test\models\TestChapter;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\test\TestSinglechoice */
/* @var $form ActiveForm */
?>
<div class="multichoice">
    <?php $form = ActiveForm::begin()?>
    <?= $form->field($model,'id')->hiddenInput()->label('')?>
    <?= $form->field($model, 'chapter')->dropDownList(ArrayHelper::map($model->getChapter(),'id','name'),['style'=>'width:250px'])?>
    <?= $form->field($model, 'source')->textInput(['style'=>'width:250px']) ?> 
    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '200',]]); ?>
    <?= $form->field($model, 'optionA')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '200',]]); ?>
    <?= $form->field($model, 'optionB')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '200',]]); ?>
    <?= $form->field($model, 'optionC')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '200',]]); ?>
    <?= $form->field($model, 'optionD')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '200',]]); ?>
    <?= $form->field($model, 'answer')->checkBoxList(['optionA'=>'A','optionB'=>'B','optionC'=>'C','optionD'=>'D'],['class'=>'checkbox']) ?>
    <?= $form->field($model, 'note')->textInput() ?>         
    <hr>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>


 