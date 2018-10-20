<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\infoitem */

$this->title = 'Update Infoitem: ' . ' ' . $model->itemid;
$this->params['breadcrumbs'][] = ['label' => 'Infoitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->itemid, 'url' => ['view', 'id' => $model->itemid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="infoitem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
