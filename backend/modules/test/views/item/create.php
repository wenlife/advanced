<?php

use yii\helpers\Html;


$this->title = 'add new';
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
<div class="col-sm-3">
<div class="list-group">
	<a href="index.php?r=test/item/create&type=1" class="list-group-item <?php if($type==1){echo 'active';}?>">
  		<h4 class="list-group-item-heading">单选题</h4>
  		<p class="list-group-item-text"></p>
  	</a>
    <a href="index.php?r=test/item/create&type=2" class="list-group-item <?php if($type==2){echo 'active';}?>">
 		<h4 class="list-group-item-heading">多选题</h4>
  		<p class="list-group-item-text"></p>
  	</a>
  	<a href="index.php?r=test/item/create&type=3" class="list-group-item <?php if($type==3){echo 'active';}?>">
  		<h4 class="list-group-item-heading">判断题</h4>
  		<p class="list-group-item-text"></p>
	</a>
    <a href="index.php?r=test/item/create&type=4" class="list-group-item <?php if($type==4){echo 'active';}?>">
  		<h4 class="list-group-item-heading">综合题</h4>
  		<p class="list-group-item-text"></p>
	</a>
</div>

</div>
<div class="col-sm-9">
  <?=$this->render('form/'.$view,['model'=>$model])?>
</div>
</div>
