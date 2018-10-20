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
  <h1>查询所有教师布置的练习题</h1>
     <table class="table table-bordered">
        <tr>
          <th>id</th>
          <th>标题</th>
          <th>状态</th>
          <th>备注</th>
          <th>创建人</th>
          <th>创建时间</th>
          <td>练习</td>
        </tr>

      <?php
        foreach ($papers as $k => $val) {
          echo "<tr>";
          echo "<td>".++$k."</td>";
          echo "<td>".$val->title."</td>";
          echo "<td>".$val->state."</td>";
          echo "<td>".$val->note."</td>";
          echo "<td>".$val->publisher."</td>";
          echo "<td>".$val->createdate."</td>";
          echo "<td>".Html::a('点击开始答题',url::toRoute(['site/test','id'=>$val->id]))."</td>";
          echo "</tr>";
        }
      ?>
      </table>


</div>
</div>