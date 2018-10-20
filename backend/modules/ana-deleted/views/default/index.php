
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '选择考试';
$this->params['breadcrumbs'][] = ['label' => 'ana', 'url' => ['score']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?=Html::dropDownlist('exam',null,ArrayHelper::map($exam,'id','title'),['class'=>'form-control'])?>
    <br>
    <button class="btn btn-primary">提交</button>
<?php ActiveForm::end() ?>
</div>