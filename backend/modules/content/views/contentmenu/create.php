<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\ContentMenu */

$this->title = 'Create Content Menu';
$this->params['breadcrumbs'][] = ['label' => 'Content Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
