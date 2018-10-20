<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\TestScore */

$this->title = 'Update Test Score: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Test Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-score-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
