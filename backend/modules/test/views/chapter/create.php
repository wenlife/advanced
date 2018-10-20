<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\test\TestChapter */

$this->title = 'Create Test Chapter';
$this->params['breadcrumbs'][] = ['label' => 'Test Chapters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-chapter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
