<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\infoitem */

$this->title = $model->itemid;
$this->params['breadcrumbs'][] = ['label' => 'Infoitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoitem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->itemid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->itemid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'itemid',
            'parentid',
            'itemname',
            'itemurl:url',
            'itemtype',
            'itemdesc',
            'itemorder',
        ],
    ]) ?>

</div>
