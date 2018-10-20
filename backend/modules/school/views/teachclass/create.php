<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachClass */

$this->title = '创建新班级';
$this->params['breadcrumbs'][] = ['label' => 'Teach Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-class-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
