<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use backend\modules\test\models\TestPaper;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Task */
/* @var $form yii\widgets\ActiveForm */
$paperModel = new TestPaper();
$papers = $paperModel->find()->where(['state'=>1])->All();
$test = ArrayHelper::map($papers,'id','title');
$test[0] = "电脑桌面作业";
//exit(ArrayHelper::map('id','title',$papers));
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '200',]]); ?>

    <?= $form->field($model, 'feedback')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '200',]]); ?>

    <?= $form->field($model, 'test')->dropDownList($test,['prompt'=>'选择练习题']) ?>

    <?= $form->field($model, 'enddate')->widget(DatePicker::className(),['dateFormat'=>'yyyy-MM-dd'])  ?>

    <?= $form->field($model, 'state')->dropDownList(['1'=>'启用','0'=>'隐藏'])?>

    <?PHP // $form->field($model, 'creator')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
