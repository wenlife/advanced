<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\content\Videolist */

$this->title = '创建新视频列表';
$this->params['breadcrumbs'][] = ['label' => 'Videolists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videolist-create">
<div class="box box-widget">
            <div class="box-header with-border">

            </div>
            <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
