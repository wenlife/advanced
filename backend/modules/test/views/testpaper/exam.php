<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Testpaper */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Testpapers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-view">

<div class="row">
<?php 
 $order = 0;
//var_export($itemsAllType);
echo Html::beginForm('','post');
foreach ($itemsAllType as $typeKey => $items) {
    foreach ($items as $itemKey => $item) {
        if ($item->getViewName()=='mmo') {
        $order+=4;
    }else{
        $order+=1;
    }
?>
<div class="well">
<div class="row">
<div class="col-sm-10 item-border">
<?php
//传入的ITEM是经过数据库选择的数据，MMO系列的子题已经被finditem读取
echo $this->render('../item/use/'.$item->getViewName(),['order'=>$order,'model'=>$item]);
?>
</div>
</div>
</div>
    <p>
<?php
}           
}
echo Html::submitButton('提交',['class'=>'btn btn-primary']);
echo Html::endForm();
?>
</p>
</div>
</div>

<style type="text/css">
label{
    font-weight: normal;
    width:100%;
    text-indent: 20px;
    line-height: 25px;
}
label>input{
    margin-right: 20px;
    width:30px;
}
label:hover{
    background-color:white;
}
</style>



