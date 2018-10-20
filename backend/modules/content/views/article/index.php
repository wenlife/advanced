<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\content\InformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="information-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'infoid',
            'infoitem',
            'headline',
            'subhead',
            'author',
            // 'publish_date',
            // 'content:ntext',
            // 'keywords',
            // 'abstract',
            // 'ishow',
            // 'level',
            // 'releaser',
            // 'release_date',
            // 'headcolor',
            // 'subhcolor',
            // 'iscomment',
            // 'isdelete',
            // 'deletedate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
