<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ana\models\AnascoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ana Scores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ana-score-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ana Score', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Import Ana Score', ['import'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'stu_id',
            'name',
            'exam_id',
            'yw',
            // 'ds',
            // 'yy',
            // 'wl',
            // 'hx',
            // 'sw',
            // 'zz',
            // 'ls',
            // 'dl',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
