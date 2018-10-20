<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\content\Video */

$this->title = $model->filename;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">

<h3 class=""><?= Html::encode($this->title) ?></h1>

<div class="row">
<div class="col-sm-8">
 <video id="video1" width="100%" style="margin-top:15px;" controls="controls">
    <source src="<?=$model->url?>" type="video/mp4" />
    Your browser does not support HTML5 video.
 </video>
<hr>
<ul class="list-inline">
<li>视频选集</li>
<?php
foreach ($collection as $key => $value) {
    echo "<li>".Html::a($value->filename,['view','id'=>$value->id])."</li>";
}
?>
<li><a href="">第一季</a></li>
<li><a href="">第一季</a></li>
<li><a href="">第一季</a></li>
</ul>
</div>

<div class="col-sm-4 well">
<h1>视频信息</h1>

<?php
    var_export($collection);
?>
</div>
</div>








    <?php DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'infoid',
            'gbid',
            'attachdesc',
            'showorder',
            'size',
            'filename',
            'expand_name',
            'url:url',
            'keywords',
            'level',
            'filestatus',
            'play',
            'releaser',
            'release_date',
            'deletedate',
        ],
    ]) ?>

