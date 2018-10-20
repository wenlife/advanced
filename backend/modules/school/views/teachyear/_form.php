<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachYearManage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teach-year-manage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => '请选择学期开始日期','language'=>"zh" ],
        'pluginOptions' => [
           'format' => 'yyyy-mm-dd', 
            'startDate' => '01-Mar-2014 12:00 AM',
           'todayHighlight' => true,
           'language'=>"zh-CN"
        ]
    ]);
     ?>

    <?= $form->field($model, 'end_date')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => '请选择学期结束日期','language'=>"zh" ],
        'pluginOptions' => [
           'format' => 'yyyy-mm-dd', 
            'startDate' => '01-Mar-2014 12:00 AM',
           'todayHighlight' => true,
           'language'=>"zh-CN"
        ]
    ]); ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
