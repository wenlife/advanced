<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

  echo '<li class="list-group-item">';
  echo Html::a($model->headline,['/site/detail',"id"=>$model->infoid]);
  echo '<span class="pull-right">'.$model->publish_date."</span>";
  echo "</li>";
?> 
