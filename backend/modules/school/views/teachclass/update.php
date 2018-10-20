<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachClass */

$this->title = 'Update Teach Class: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Teach Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teach-class-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
