<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachManage */

$this->title = '任教管理';
$this->params['breadcrumbs'][] = ['label' => 'Teach Manages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-manage-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
