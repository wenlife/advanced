<?php
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
//var_export($compare);
//exit();
?>
<h1><?=$school?>班级对应设置</h1>
<div class="testService-default-index">
<a href="<?=Url::toRoute(['index','id'=>$exam])?>" class="btn btn-primary">返回</a>
<hr>
<div class="row">
<table class="table table-borderd">
  <thead>
    <tr>
      <th>成绩表班级</th>
      <th>系统班级</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($reload as $key1 => $value1) {
      echo "<tr><td>";
      echo $value1;
      echo "</td><td>";
      echo $view_res[$key1];
      echo "</td></tr>";
    }
    ?>
  </tbody>
</table>
</div>
</div>
