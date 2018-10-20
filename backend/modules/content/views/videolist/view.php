<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\content\Videolist */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videolists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videolist-view">
<p>
    <?=Html::a('添加文件',['/content/video/upload','infoid'=>$model->id],['class'=>'btn btn-primary'])?>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this videolist?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<div class="row">
    <div class="col-xs-6 col-md-6">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">视频列表</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'note',
            'cid',
            'iscollection',
            'keywords',
            'date',
            'author',
            'cover',
        ],
        ]) ?>
        </div>
    </div>
    </div>
    <div class="col-xs-6 col-md-6">


    <div class="box">
            <div class="box-header">
              <h3 class="box-title">视频列表</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                 <tr><th>标题</th><th>描述</th><th>顺序</th><th>操作</th></tr>
                <?php
                    foreach ($videos as $key => $video) {
                        echo "<tr><td>";
                        echo Html::a($video->filename,['video/view','id'=>$video->id]);
                        echo "</td><td>";
                        echo $video->attachdesc;
                        echo "</td><td>";
                        echo $video->showorder;
                        echo "</td><td>";
                        echo Html::a('删除',['video/delete','id'=>$video->id,'listid'=>$id],[
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => '你确定要删除该视频吗?',
                                    'method' => 'post',
                                ],
                            ]);
                        echo "</td></tr>";
                    }

                ?>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
</div>



</div>
