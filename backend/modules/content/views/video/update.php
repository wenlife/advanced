<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\content\Video */

$this->title = 'Update Video: ' . ' ' . $model->attachid;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->attachid, 'url' => ['view', 'id' => $model->attachid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="video-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
