<?php
/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Testpaper */
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->title;
//var_export($myAnswer);
?>
<h1 class="title"><?=$model->title?><span class="glyphicon glyphicon-ok"></span>
                                   <span class="score"><?=$score->score?>分</span>
                  </h1>
<div class="box-body">
<?php 
    $order = 0;
    foreach ($itemsAllType as $typeKey => $items) {
        foreach ($items as $itemKey => $item) {
            if ($item->getViewName()=='mmo') {
            	$order+=4;
            }else{
            	$order++;
            }
        //exit(var_export($stu_answer));
	    echo $this->render('display/'.$item->getViewName(),['order'=>$order,'model'=>$item,'myAnswer'=>$myAnswer]);
		}
	}
?>
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
.score{
    float:right;
    font-size: 80px;
    color:red;

}
.grain{
    float: right;
    color:blue;
    font-size: 80px;
}
</style>

