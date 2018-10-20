<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-teacher-index">

    <p>
        <?= Html::a('Create User Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            ['attribute'=>'subject','value'=>function($model){
                $subject = Yii::$app->params['subject'];
                return $subject[$model->subject];
            }],
             ['attribute'=>'gender','value'=>function($model){return $model->gender==1?'男':'女';}],
            'username',
            'secode',
            'note',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{setlogin}{view}{update}{delete}',
              'buttons'=>[
                'setlogin'=>function($url,$model,$key){
                    return Html::a('<span class="glyphicon glyphicon-cog"></span',$url,['title'=>'添加']);
                },

              ],
              'headerOptions'=>['width'=>'180']
            ],
        ],
    ]); ?>

</div>
