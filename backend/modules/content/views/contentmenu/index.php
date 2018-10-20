<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\content\models\Infoitem;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\ContentmenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
.big{
  color:green;
  margin:0px 5px 0px 5px;
}
</style>
<div class="content-menu-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('发布文章', ['article/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('发布视频', ['videolist/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('发布图片', ['picturelist/create'], ['class' => 'btn btn-success']) ?>
    </p>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            ['attribute'=>'menuid','value'=>'menuname.itemname',
            'filter'=>Infoitem::find()
                     ->select(['itemname','itemid'])
                     ->indexBy('itemid')
                     ->column(),
            ],
            //'articleid',
            ['attribute'=>'type','value'=>function($model){
               $arr = ['information'=>'文章','video'=>'视频','picture'=>'图片'];
               return $arr[$model->type];
            },
            'filter'=>['information'=>'文章','video'=>'视频','picture'=>'图片']
            ],
            
            // 'note',
             'author',
             'publish_date',
             ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{score}{view}{update}{delete}',
              'buttons'=>[
                'view'=>function($url,$model,$key){
                    switch ($model->type) {
                        case 'information':
                            $url = ['article/view','id'=>$model->articleid];
                            break;
                        case 'picture':
                            $url = ['picturelist/view','id'=>$model->articleid];
                        break;

                        case 'video':
                            $url = ['videolist/view','id'=>$model->articleid];
                        break;
                        
                        default:
                            # code...
                            break;
                    }
                    return Html::a('<span class="glyphicon glyphicon-eye-open big" ></span',$url,['title'=>'查看']);
                },
                'update'=>function($url,$model,$key){
                    switch ($model->type) {
                        case 'information':
                            $url = ['article/update','id'=>$model->articleid];
                            break;
                        case 'picture':
                            $url = ['picturelist/update','id'=>$model->articleid];
                        break;

                        case 'video':
                            $url = ['videolist/update','id'=>$model->articleid];
                        break;
                        
                        default:
                            # code...
                            break;
                    }
                    return Html::a('<span class="glyphicon glyphicon-pencil big"></span',$url,['title'=>'编辑']);
                },
                'delete'=>function($url,$model,$key){
                    switch ($model->type) {
                        case 'information':
                            $url = ['delete','type'=>'information','id'=>$model->articleid];
                            break;
                        case 'picture':
                            $url = ['delete','type'=>'picture','id'=>$model->articleid];
                        break;
                        case 'video':
                            $url = ['delete','type'=>'video','id'=>$model->articleid];
                        break;
                        
                        default:
                            # code...
                            break;
                    }
                    return Html::a('<span class="glyphicon glyphicon-trash big"></span',$url,['title'=>'删除','data-method'=>'post','data-confirm'=>'确认要删除吗？']);
                },
              ],
              'headerOptions'=>['width'=>'180']
            ],
        ],
    ]); ?>

</div>
