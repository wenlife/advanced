<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VideolistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '视频管理列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videolist-index">
<p>
    <?= Html::a('创建新视频内容', ['create'], ['class' => 'btn btn-success']) ?>
</p>
 <style type="text/css">
.big{
  color:green;
  margin:0px 5px 0px 5px;
}
</style>
<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'title',
        'note',
        ['attribute'=>'cid','value'=>'menuname.itemname'],
        ['attribute'=>'iscollection','value'=>function($model){
            $isarr = ['1'=>'合集','0'=>'单集'];
            return $isarr[$model->iscollection];
        }],
        // 'keywords',
         'date',
         'author',
       ['class' => 'yii\grid\ActionColumn',
         'header'=>'操作',
          'template'=>'{cover}{upload}{view}{update}{delete}',
          'buttons'=>[
            'cover'=>function($url,$model,$key){
                return Html::a('<span class="glyphicon glyphicon-picture big"></span',['/content/videolist/cover','id'=>$model->id],['title'=>'上传封面']);
            },
            'upload'=>function($url,$model,$key){
                return Html::a('<span class="glyphicon glyphicon-upload big"></span',['/content/video/upload','infoid'=>$model->id],['title'=>'添加文件']);
            },
          ],
          'headerOptions'=>['width'=>'180']
        ],

    ],
]);?>

</div>
