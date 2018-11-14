<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '练习题列表';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->user->identity->username;
?>
<section class="content">
<div class="row">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">练习题集</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>id</th>
          <th>标题</th>
          <th>备注</th>
          <th>创建人</th>
          <th>创建时间</th>
          <td>练习</td>
        </tr>
        </thead>
        <tbody>
      <?php
        foreach ($papers as $k => $val) {
          echo "<tr>";
          echo "<td>".++$k."</td>";
          echo "<td>".$val->title."</td>";
          //echo "<td>".$val->state."</td>";
          echo "<td>".$val->note."</td>";
          echo "<td>".$val->publisher."</td>";
          echo "<td>".date("Y-m-d",$val->createdate)."</td>";
          echo "<td>".Html::a('开始答题',url::toRoute(['/center/test','id'=>$val->id]))."</td>";
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