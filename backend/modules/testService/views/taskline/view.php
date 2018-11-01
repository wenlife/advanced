<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\Taskline */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tasklines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taskline-view">

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
            'grade',
            'banji',
            'line1',
            'line2',
            'line3',
            'line4',
            'note',
        ],
    ]) ?>

</div>
