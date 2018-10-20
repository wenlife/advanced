<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\ana\models\AnaScore */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ana Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ana-score-view">

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
            'stu_id',
            'name',
            'exam_id',
            'yw',
            'ds',
            'yy',
            'wl',
            'hx',
            'sw',
            'zz',
            'ls',
            'dl',
        ],
    ]) ?>

</div>
