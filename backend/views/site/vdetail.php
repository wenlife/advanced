<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\content\Videolist */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'site/videlist', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videolist-view">
<?php
   $video = null;
   if($vid==null)
   {
         $video = current($videos);
   }else{
      foreach ($videos as $key => $value) {
         if ($value->id ==$vid) {
            $video = $value;
            break;
         }
      }   
   }
?>
</table>
</div>
<div class="row">
<div class="col-sm-8">
<h1 class="text-center" style="border-bottom: 1px solid #ccc"><?= Html::encode($this->title) ?></h1>
</div>
<div class="col-sm-9">
 
 <video id="video1" width="100%" style="margin-top:15px;" controls>
    <source src="<?=$video->url?>" type="video/mp4" />
    Your browser does not support HTML5 video.
 </video>

<?php// }?>

<hr>
<ul class="list-inline">
<li>视频选集</li>
<?php
foreach ($videos as $key => $value) {
    echo "<li>".Html::a($value->filename,['vdetail','id'=>$model->id,'vid'=>$value->id])."</li>";
}
?>

</ul>
</div>

<div class="col-sm-3">
<h1>视频信息</h1>
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
          //  'picture',
        ],
    ]) ?>

</div>
</div>