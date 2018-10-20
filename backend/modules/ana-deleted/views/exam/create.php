<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\ana\models\AnaExam */

$this->title = 'Create Ana Exam';
$this->params['breadcrumbs'][] = ['label' => 'Ana Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ana-exam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
