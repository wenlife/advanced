<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\test\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '课堂任务';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建任务', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'content:ntext',
            //'feedback:ntext',
            ['attribute'=>'test','value'=>'paper.title'],
             'enddate',
            // 'createdate',
            ['attribute'=>'state','value'=>function($model){return $model->state==1?'激活':'隐藏';}],
            ['attribute'=>'creator','value'=>'teacher.name'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
