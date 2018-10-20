<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\ScWenke */

$this->title = 'Update Sc Wenke: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sc Wenkes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sc-wenke-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
