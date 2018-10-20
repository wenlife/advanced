<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员与教师';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建新的管理员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'name',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
             'email:email',
             'status',
             'type',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{resetpwd}{view}{update}{delete}',
              'buttons'=>[
                'resetpwd'=>function($url,$model,$key){
                    return Html::a('<span class="glyphicon glyphicon-hand-up"></span',$url,['title'=>'添加']);
                },

              ],
              'headerOptions'=>['width'=>'180']
            ],
        ],
    ]); ?>

</div>
