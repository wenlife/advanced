<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '任务查询';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->user->identity->username;
?>
<section class="content">
<div class="row">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">查询任课教师布置的任务</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <thead>
                  <tr>
          <th>次数</th>
          <th>标题</th>
          <th>内容</th>
          <th>状态</th>
        </tr>
        </thead>
        <tbody>
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
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
</div>
</div>
</section>
