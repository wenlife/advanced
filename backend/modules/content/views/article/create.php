<div class="information-create">
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\content\Information */

$this->title = '新增文章';
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="information-create">
<div class="box box-widget">
            <div class="box-header with-border">

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
