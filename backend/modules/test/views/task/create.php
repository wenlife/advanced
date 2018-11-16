<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Task */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
