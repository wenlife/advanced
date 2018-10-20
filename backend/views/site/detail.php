<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\content\Information */

$this->title = $model->headline;
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well" style=" background:url(images/title.png) repeat-x" >
             
    <div class=" page-header" >
    <h3 class=" text-center text-info"><?= Html::encode($this->title) ?></h3>
    <ul class="list-inline text-center text-success" style=" font-size:12px">
              <li>作者:<?=$model->author?></li>
        <li>发布者:<?=$model->releaser?></li>
        <li>写作时间:<?=$model->release_date?></li>
        <li>发布时间:<?=$model->publish_date?></li>
        <li>重要级别:<?=$model->level?></li>
        <li>截止时间:<?=$model->deletedate?></li>
    </ul>
    </div>
<div class="article_detail">
<?=$model->content?>
<div style="clear:both"></div>
</div>
             
        </div>

