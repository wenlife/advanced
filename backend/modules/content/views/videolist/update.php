<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\content\Videolist */

$this->title = '修改视频播放列表';
$this->params['breadcrumbs'][] = ['label' => 'Videolists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="videolist-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
