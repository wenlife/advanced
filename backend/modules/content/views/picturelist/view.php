<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Picturelist */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Picturelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picturelist-view">  
<p>
<?= Html::a('上传图片', ['upload', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<?= Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
]) ?>
</p>
<div class="row">
    <div class="col-xs-5 col-md-5">
<div class="box box-widget">
<div class="box-header with-border">
详细信息
</div>
<div class="box-body no-padding">
<div class='row'>
<div class="col-sm-12">
<div id="carousel1" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#carousel1" data-slide-to="0" class="active"></li>
<?php 
    for ($i=1; $i < count($pictures) ; $i++) { 
        echo '<li data-target="#carousel1" data-slide-to="'.$i.'"></li>';
    }
?>
</ol>
<div class="carousel-inner" role="listbox">
<?php foreach($pictures as $key=>$picture){ ?>
  <div class="item <?php if($key==0) echo 'active'; ?>">
  <img src="<?=$picture->url?>" alt="First slide image" class="center-block">
    <div class="carousel-caption">
      <h3><?=$picture->headline?></h3>
      <p><?=$picture->describes?></p>
    </div>
  </div>
<?php } ?>

</div>
<a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span></a>
<a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
</div>
</div>
    <div class="row">
    <div class="col-xs-12 col-md-12">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'note',
            'cid',
            'is_collection',
            'kewords',
            'date',
            'author',
            'cover',
        ],
    ]) ?>
</div>
</div>

</div>
</div>
</div>



<div class="col-xs-6 col-md-6">
<div class="box box-widget">
<div class="box-header with-border">
包含图片
</div>
<div class="box-body no-padding">
<table class="table table-bordered">
<tr><th>标题</th><th>描述</th><th>顺序</th><th>操作</th></tr>
<?php
foreach ($pictures as $key => $picture) {
    echo "<tr><td>";
    echo "<image src=$picture->url  width=200px />";
    echo "</td><td>";
    echo $picture->headline.'>>'.$picture->describes.'>>'.$picture->keywords;
    echo "</td><td>";
    echo $picture->showorder;
    echo "</td><td>";
    echo Html::a('删除',['deletepic','id'=>$picture->id,'listid'=>$model->id],[
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除该图片吗?',
                'method' => 'post',
            ],
        ]);
    echo "</td></tr>";
}

?>
</table>
</div>
</div>
    </div>
</div>
</div>
