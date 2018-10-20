<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\testService\models\ScwenkeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sc Wenkes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sc-wenke-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sc Wenke', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'test_id',
            'stu_id',
            'stu_name',
            'stu_class',
            //'stu_school',
            //'yw',
            //'ds',
            //'yy',
            //'zz',
            //'ls',
            //'dl',
            //'zf',
            //'mc',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
