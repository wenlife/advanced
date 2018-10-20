<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guest\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '教师管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">
<div class="box box-success">
    <div class="box-header">

    </div>
    <!-- /.box-header -->
    <div class="box-body">
    
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建新教师', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'pinx',
            ['attribute'=>'subject','value'=>function($model){
                $subjects = CommonFunction::getSubjects();
                return $subjects[$model->subject];
            }],
            ['attribute'=>'type','value'=>function($model){
                $type = CommonFunction::getTeacherType();
                return $type[$model->type];
            }],
            'graduate',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
