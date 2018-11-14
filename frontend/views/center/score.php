<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '成绩查询';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->user->identity->username;
?>
<section class="content">
<div class="row">
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">查询最近的练习成绩</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <thead>
          <tr><th>次数</th><th>测试内容</th><th>得分</th><th>测试日期</th><th>查看答案</th></tr>
        </thead>
        <tbody>
        <?php
          foreach ($score as $k => $val) {
            echo "<tr>";
            echo "<td>".++$k."</td>";
            echo "<td>".$val->test['title']."</td>";
            echo "<td>".$val->score."</td>";
            echo "<td>".date('Y-m-d',$val->date)."</td>";
            echo "<td>";
            echo "<a href=".Url::toRoute(['review','scoreid'=>$val->id]).">解析</a>";
            echo "</td>";
            echo "</tr>";
          }
        ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
</div>
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">学科考试成绩情况</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <thead>
          <tr><th>次数</th><th>测试内容</th><th>得分</th><th>测试日期</th><th>查看答案</th></tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
</div>
</div>
</section>