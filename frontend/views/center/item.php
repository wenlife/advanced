<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

  echo '<p class="item">';
  echo Html::a($model->headline,['/site/detail',"id"=>$model->infoid]);
  echo '<span class="pull-right">'.date('Y-m-d',strtotime($model->publish_date))."</span>";
  echo "</p>";
?> 
<style type="text/css">
	.item{
		padding-bottom: 5px;
		border-bottom: 1px solid #eee;
		text-indent: 15px;
	}
</style>
