<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\content\Information */

$this->title = '更改文章';
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="information-update">
<div class="box box-widget">
            <div class="box-header with-border">
                <h1><?= Html::encode($model->headline) ?></h1>

              <!-- /.user-block -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
 </div>
</div>

</div>
