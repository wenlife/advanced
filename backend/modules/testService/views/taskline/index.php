<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\testService\models\TasklineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '指标分配';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taskline-index">
    <p>
        <?= Html::a('创建指标', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('导入指标', ['import'], ['class' => 'btn btn-warning']) ?>
    </p>
    <div class="box">
  <div class="box-header with-border">
    <i class="ion ion-clipboard"></i>
    <h3 class="box-title">（1000/1001）的班级为该年级的全市（理科/文科）指标</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'grade',
            'banji',
            'line1',
            'line2',
            'line3',
            'line4',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
