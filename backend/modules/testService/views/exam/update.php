<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\Exam */

$this->title = 'Update Exam: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '考试', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exam-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
