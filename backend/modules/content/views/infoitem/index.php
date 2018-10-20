<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\infoitemsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Infoitems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoitem-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Infoitem', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'itemid',
            'parentid',
            'itemname',
            'itemurl:url',
            ['label'=>'itemType','attribute'=>'itemtype','value'=>function($model){
                     $itemType = Yii::$app->params['itemType'];
                     return $itemType[$model->itemtype];
                     //return 1;
                 }],
            // 'itemdesc',
            // 'itemorder',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<div>
<h1>网站地图</h1>
<?php
foreach ($items as $key => $value) {
   if ($value->level ==1) {
      echo "<br>";
      echo $value->itemname;
      $children = findMyChildren($value->itemid,$items);
      if (!empty($children)) {
          echo '>';
          foreach ($children as $k => $val) {
             
              echo $val->itemname.'+';
          }
      }
   }
}


function findMyChildren($id,$items){
   $children = array();
   foreach ($items as $key => $value) {
       if ($value->parentid == $id) {
          // findMyChildren($value->itemid,$items);
           $children[$value->itemid] = $value;
       }
   }
   return $children;
}

?>
</div>
