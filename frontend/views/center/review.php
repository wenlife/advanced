<?php
/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Testpaper */
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
//var_export($myAnswer);
?>
<section class="content self">
<div class="row">
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="title"><?=$model->title?>
        <span class="score"><?=$score->score?>分</span>
        </h1>
    </div>
    <!-- /.box-header -->
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
</div>
</div>
</section>


<style type="text/css">
.self label{
    font-weight: normal;
    width:100%;
    text-indent: 20px;
    line-height: 25px;
}
.self label>input{
    margin-right: 20px;
    width:30px;
}
.self label:hover{
    background-color:white;
}
@font-face{
    font-family: "李旭科书法1.4";
    src:url("font/lxk.ttf");
}
.self .title{
    text-align: center;
    font-family: "李旭科书法1.4";
    margin: 20px;
    padding: 20px;
    border-top: 2px solid #eee;
    border-bottom: 1px solid #eee;
    color:green;
}
.self .score{
    float:right;
    font-size: 80px;
    color:red;

}
.self .grain{
    float: right;
    color:blue;
    font-size: 80px;
}
</style>

