<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Task */

$this->title = '修改任务';
$this->params['breadcrumbs'][] = ['label' => '任务', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="task-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
