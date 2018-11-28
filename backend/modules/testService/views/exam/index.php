<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\testService\models\ExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '考试管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> 新建考试', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="box">
  <div class="box-header with-border">
    <i class="ion ion-clipboard"></i>

    <h3 class="box-title">全部考试</h3>
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
            'stu_grade',
            ['attribute'=>'type','value'=>'typename'],
            'date',
            'note',
             ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{view}{update}{delete}',
              'buttons'=>[
                'view'=>function($url,$model,$key){
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span',['/testService/analysis/index','id'=>$model->id],['title'=>'添加']);
                },
              ],
              'headerOptions'=>['width'=>'180']
            ],
        ],
    ]); ?>

  </div>
</div>


</div>
