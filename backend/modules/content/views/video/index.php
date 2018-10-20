<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-bordered">
        <tr><th>ID</th><th>标题</th><th>infoid</th><th>描述</th><th>添加文件</th></tr>

        <?php
            foreach ($model as $key => $value) {
                echo "<tr><td>";
                echo $value->id;
                echo "</td><td>";
                echo $value->filename;
                echo "</td><td>";
                echo $value->infoid;
                echo "</td><td>";
                echo $value->attachdesc;
                echo "</td><td>";
                echo "<a>添加文件</a>";
                echo "</td></tr>";
            }
        ?>

    </table>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'infoid',
            //'gbid',
            'attachdesc',
            'showorder',
             'size',
             'filename',
            // 'expand_name',
            // 'url:url',
            // 'keywords',
            // 'level',
            // 'filestatus',
            // 'isdl',
            // 'releaser',
            // 'release_date',
            // 'deletedate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
