<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachYearManage */

$this->title = 'Update Teach Year Manage: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Teach Year Manages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teach-year-manage-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
