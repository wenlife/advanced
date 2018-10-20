<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachYearManage */

$this->title = '新建教学年度';
$this->params['breadcrumbs'][] = ['label' => 'Year', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-year-manage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
