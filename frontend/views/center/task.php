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
      <h1>查询任课教师布置的任务</h1>
      <table class="table table-bordered">
        <tr>
          <th>次数</th>
          <th>标题</th>
          <th>内容</th>
          <th>状态</th>
        </tr>

      <?php
        foreach ($tasks as $k => $val) {
          echo "<tr>";
          echo "<td>".++$k."</td>";
          echo "<td>".$val->title."</td>";
          echo "<td>".$val->content."</td>";
          echo "<td>".$val->state."</td>";
          echo "</tr>";
        }
      ?>
      </table>
    </div>
    <div class="row my">
      <div class="col-md-6"></div>
      <div class="col-md-6"></div>
    </div>
</div>
</div>
