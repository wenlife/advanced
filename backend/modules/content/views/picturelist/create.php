<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Picturelist */

$this->title = '新建图片列表';
$this->params['breadcrumbs'][] = ['label' => '图片列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picturelist-create">
<div class="box box-widget">
<div class="box-header with-border">
	<?= Html::encode('请输入下列内容') ?>
</div>
<div class="box-body">
<?= $this->render('_form', ['model' => $model,]) ?>
</div>
</div>
</div>
