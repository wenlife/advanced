<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\ScLike */

$this->title = 'Create Sc Like';
$this->params['breadcrumbs'][] = ['label' => 'Sc Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sc-like-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
