<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\ana\models\AnaScore */

$this->title = 'Create Ana Score';
$this->params['breadcrumbs'][] = ['label' => 'Ana Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ana-score-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
