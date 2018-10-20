<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guest\models\TeachClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '班级管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-class-index">
<p>
<?= Html::a('创建新班级', ['create'], ['class' => 'btn btn-success']) ?>
<?= Html::a('指标分配', ['/testService/taskline'], ['class' => 'btn btn-success']) ?>
</p>

<div class="box box-success">
    <div class="box-header">

    </div>
    <!-- /.box-header -->
    <div class="box-body">
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'grade',
                'serial',
                'type',
                'school',
                //'note',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <!-- /.box-body -->
  </div>
</div>
