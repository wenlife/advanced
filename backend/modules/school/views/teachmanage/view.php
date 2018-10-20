<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachManage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teach Manages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-manage-view">

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
            'year_id',
            'class_id',
            'teacher_id',
            'subject',
            'note',
        ],
    ]) ?>

</div>
