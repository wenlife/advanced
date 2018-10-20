<?php
/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\Testpaper */
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Testpapers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-view">
<div class="r1ow">
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</p>
<hr>
<?php 
$order = 1;
foreach ($itemsAllType as $typeKey => $items) {
    foreach ($items as $itemKey => $item) {
        if ($item->getViewName()=='mmo') {
        $order+=3;
}
?>

<div class="well">
<div class="row">
<div class="col-sm-10 item-border">
<?php
  echo $this->render('../item/use/'.$item->getViewName(),['order'=>$order++,'model'=>$item]);
?>
</div>
</div>
</div>
<?php
}
}
?>
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



