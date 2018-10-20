<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guest\models\TeachYearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '教学年度管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-year-manage-index">
 <div class="box box-success">
    <div class="box-header">

    </div>
    <!-- /.box-header -->
    <div class="box-body">   

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建教学时间表', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'start_date',
            'end_date',
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
