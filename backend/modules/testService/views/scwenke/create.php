<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\ScWenke */

$this->title = 'Create Sc Wenke';
$this->params['breadcrumbs'][] = ['label' => 'Sc Wenkes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sc-wenke-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
