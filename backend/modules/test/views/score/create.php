<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\TestScore */

$this->title = 'Create Test Score';
$this->params['breadcrumbs'][] = ['label' => 'Test Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-score-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
