<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\ScWenke */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sc Wenkes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sc-wenke-view">

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
            'test_id',
            'stu_id',
            'stu_name',
            'stu_class',
            'stu_school',
            'yw',
            'ds',
            'yy',
            'zz',
            'ls',
            'dl',
            'zf',
            'mc',
            'note',
        ],
    ]) ?>

</div>
