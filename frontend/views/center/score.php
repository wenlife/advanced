<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
$id = Yii::$app->user->identity->username;
?>
<div class="site-index">

    <div class="body-content">
    <div class="row">
      <h1>查询最近的练习成绩</h1>

      <table class="table table-bordered">
        <tr>
          <th>次数</th>
          <th>测试内容</th>
          <th>得分</th>
          <th>测试日期</th>
          <th>回顾</th>
        </tr>

      <?php

        foreach ($score as $k => $val) {
          echo "<tr>";
          echo "<td>".++$k."</td>";
          echo "<td>".$val->test['title']."</td>";
          echo "<td>".$val->score."</td>";
          echo "<td>".date('Y-m-d',$val->date)."</td>";
          echo "<td>";
          echo "<a href=".Url::toRoute(['review','scoreid'=>$val->id]).">回顾</a>";
          echo "</td>";
          echo "</tr>";
        }


      ?>

      </table>

      <?php
        //var_export($score);
      ?>
    </div>

    <div class="row my">
      <div class="col-md-6"></div>
      <div class="col-md-6"></div>
    </div>
</div>
</div>