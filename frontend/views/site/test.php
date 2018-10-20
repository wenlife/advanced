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
<h1 class="title"><?=$model->title?></h1>
<?php 
 $order = 0;
//var_export($itemsAllType);
echo Html::beginForm('','post');
foreach ($itemsAllType as $typeKey => $items) {

    foreach ($items as $itemKey => $item) {
        if ($item->getViewName()=='mmo') {
        $order+=3;
    }else{
        $order+=1;
    }
?>
<div class="well">
<div class="row">
<div class="col-sm-10 item-border">
<?php
echo $this->render('use/'.$item->getViewName(),['order'=>$order,'model'=>$item]);
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
@font-face{
    font-family: "李旭科书法1.4";
    src:url("font/lxk.ttf");
}
.title{
    text-align: center;
    font-family: "李旭科书法1.4";
    margin: 20px;
    padding: 20px;
    border-top: 2px solid #eee;
    border-bottom: 1px solid #eee;
    color:green;
}
</style>



