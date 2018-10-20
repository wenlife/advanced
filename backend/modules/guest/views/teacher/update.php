<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\Teacher */

$this->title = 'Update Teacher: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
