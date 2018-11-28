<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\Taskline */

$this->title = 'Update Taskline';
$this->params['breadcrumbs'][] = ['label' => 'Tasklines', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="taskline-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
