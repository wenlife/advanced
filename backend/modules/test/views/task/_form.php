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
//exit(ArrayHelper::map('id','title',$papers));
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '200',]]); ?>

    <?= $form->field($model, 'feedback')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'test')->dropDownList(ArrayHelper::map($papers,'id','title')) ?>

    <?= $form->field($model, 'enddate')->widget(DatePicker::className(),['dateFormat'=>'yyyy-MM-dd'])  ?>

    <?= $form->field($model, 'state')->dropDownList(['1'=>'启用','0'=>'隐藏'])?>

    <?PHP // $form->field($model, 'creator')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
