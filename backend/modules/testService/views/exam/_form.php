<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use backend\modules\testService\models\Exam;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\Exam */
/* @var $form yii\widgets\ActiveForm */
function gradelist()
{
    $year = date('Y');
    $yearRange = range($year-3,$year+3);
    foreach ($yearRange as $key => $value) {
        $gradelist[$value] = $value.'届';
    }
    return $gradelist;
}
$exams = Exam::find()->all();
$cmp  = ArrayHelper::map($exams,'id','title');
$cmp[0] = '无';

?>

<div class="exam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stu_grade')->dropDownList(gradelist(),['prompt'=>'请选择年级......']) ?>
    
     <?= $form->field($model, 'type')->dropDownList(array('1'=>'校级','2'=>'市级','3'=>'国家级','4'=>'其他')) ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => '请选择日期','language'=>"zh" ],
        'pluginOptions' => [
           'format' => 'yyyy-mm-dd', 
           'startDate' => '01-Mar-2014 12:00 AM',
           'autoclose' => true,
           'todayHighlight' => true,
           'minView'=>'month',
           'language'=>"zh-CN"
        ]
    ]);
    ?>
      <?= $form->field($model, 'compare')->dropDownList($cmp) ?> 
    
    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
