<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\infoitem */

$this->title = 'Create Infoitem';
$this->params['breadcrumbs'][] = ['label' => 'Infoitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoitem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
