<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '学生概览';
$this->params['breadcrumbs'][] = 'index';
?>
<div class="user-index">

    <h1><?php Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('导入学生', ['import'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('删除学生', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            'name',
            ['attribute'=>'gender','value'=>function($model){return $model->gender==1?'男':'女';}],
            ['attribute'=>'class','value'=>function($model){return $model->teachclass->title;}],
            ['attribute'=>'status','value'=>function($model){return $model->status==10?'正常':'锁定';}],
            ['attribute'=>'type','value'=>function($model){return $model->status==1?'普通':'其他';}],
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
