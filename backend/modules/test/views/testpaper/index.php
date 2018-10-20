<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\test\models\TestpaperSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testpapers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Testpaper', ['/test/item/itemlist'], ['class' => 'btn btn-success']) ?>
         <?= Html::a('开始测试', ['exam'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'state',
            //'items',
            ['attribute'=>'score','value'=>function($model){ return unserialize($model->score)['sum'];}],
            // 'note',
            // 'publisher',
            // 'createdate',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{score}{exam}{view}{update}{delete}',
              'buttons'=>[
                'exam'=>function($url,$model,$key){
                    return Html::a('<span class="glyphicon glyphicon-hand-up"></span',$url,['title'=>'查看答案']);
                },
                'score'=>function($url,$model,$key){
                    return Html::a('<span class="glyphicon glyphicon-phone"></span',['score','testid'=>$model->id],['title'=>'查看得分']);
                },
              ],
              'headerOptions'=>['width'=>'180']
            ],

        ],
    ]); ?>

</div>
