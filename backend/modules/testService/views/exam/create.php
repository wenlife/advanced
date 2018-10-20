<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\testService\models\Exam */

$this->title = '创建新的考试';
$this->params['breadcrumbs'][] = ['label' => '考试', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
