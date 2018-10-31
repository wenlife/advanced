<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '导入成绩';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'exam')->dropDownList(ArrayHelper::map($exams,'id','title'))->label('考试') ?>
    <?= $form->field($model, 'type')->dropDownList(['1'=>'理科成绩','2'=>'文科成绩'],['prompt'=>'请选择文理成绩'])->label('成绩类型') ?>
    <?= $form->field($model, 'file')->fileInput()->label('成绩文件') ?>
    <button class="btn btn-primary">提交</button>
<?php ActiveForm::end() ?>
</div>