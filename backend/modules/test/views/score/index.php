<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\test\models\TestscoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '成绩总体分析';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-score-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Score', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('总体分析', ['analysis'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'testid',
            //'answer:ntext',
            'score',
            // 'date',
            // 'backup',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
