<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use backend\modules\content\libary\InformationConverse;
$converter = new InformationConverse($model);
  echo '<li class="list-group-item">';
  echo Html::a($model->title,$converter->contentFrontView());
  echo '<span class="pull-right">'.$model->publish_date."</span>";
  echo "</li>";
?>

