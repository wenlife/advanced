<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\UserBanji;
use backend\modules\ana\models\AnaExam;

/* @var $this yii\web\View */
/* @var $model backend\modules\ana\models\AnaExam */
/* @var $form yii\widgets\ActiveForm */
$grades = UserBanji::find()->select(['grade'])->distinct()->all();
$arr = array();
foreach ($grades as $key => $value) {
    $arr[$value['grade']] =$value['grade'];
}
$exams= AnaExam::find()->all();


?>

<div class="ana-exam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grade')->dropDownList($arr) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->dropDownList(['1'=>'校级','2'=>'市级','3'=>'省级']) ?>
    
    <?= $form->field($model, 'compare')->dropDownList(ArrayHelper::map($exams,'id','title')) ?> 

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
