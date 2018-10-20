<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '导入学生账号';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">
<p>*****批量注册要分班级进行******</p>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'class')->dropDownList(ArrayHelper::map($class,'id','title')) ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <button class="btn btn-primary">提交</button>
<?php ActiveForm::end() ?>
</div>
