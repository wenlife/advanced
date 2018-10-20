<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Picturelist */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Picturelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="picturelist-update">
<?= $this->render('_form', ['model' => $model,]) ?>
</div>
