<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\content\Information */

$this->title = $model->headline;
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['/center']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row">
<div class="box box-primary">
    <div class="box-header with-border">
          <h3 class=" text-center text-info"><?= Html::encode($this->title) ?></h3>
        <ul class="list-inline text-center text-success" style=" font-size:12px">
            <li>作者:<?=$model->author?></li>
            <li>发布者:<?=$model->releaser?></li>
            <li>写作时间:<?=date('Y-m-d',strtotime($model->release_date))?></li>
            <li>发布时间:<?=date('Y-m-d',strtotime($model->publish_date))?></li>
        </ul>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <?=$model->content?>
    </div>
</div>
</div>
</section>

