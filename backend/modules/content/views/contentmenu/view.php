<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\ContentMenu */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Content Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'menuid',
            'articleid',
            'type',
            'title',
            'note',
            'author',
            'publish_date',
        ],
    ]) ?>

</div>
