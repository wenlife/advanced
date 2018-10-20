<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '导入成绩';
$this->params['breadcrumbs'][] = ['label' => 'ana', 'url' => ['score']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'param')->dropDownList(ArrayHelper::map($exams,'id','title'))->label('考试') ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <button class="btn btn-primary">提交</button>
<?php ActiveForm::end() ?>
</div>
