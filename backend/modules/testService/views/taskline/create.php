<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\Taskline */

$this->title = 'Create Taskline';
$this->params['breadcrumbs'][] = ['label' => 'Tasklines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taskline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
