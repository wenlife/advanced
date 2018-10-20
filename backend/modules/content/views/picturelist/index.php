<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\PicturelistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '图片列表管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picturelist-index">
<p>
    <?= Html::a('新建图片列表', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="box box-widget">
        <div class="box-header with-border">

          <!-- /.user-block -->
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
        'note',
        ['attribute'=>'cid','value'=>'menuname.itemname'],
        ['attribute'=>'is_collection','value'=>function($model){
            $arr = [0=>'单集',1=>'合集'];
            return $arr[$model->is_collection];
        }],
        // 'kewords',
        // 'date',
        // 'author',
        // 'cover',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>
</div>

</div>
