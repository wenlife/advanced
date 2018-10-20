<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChapterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Chapters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-chapter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Chapter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'grade',
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
