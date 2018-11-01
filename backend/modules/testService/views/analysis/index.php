<?php
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use backend\libary\CommonFunction;
$subject_name = CommonFunction::getSubjects();
$this->title = $exam->title."--考试成绩分析";
$this->params['breadcrumbs'][] = '总体成绩分析（表格显示不全时可以左右拖动）';
?>
<div class="testService-default-index">
 <?php 
 if (!Yii::$app->user->isGuest) {
 ?>
<a href="<?=Url::toRoute(['import','id'=>$exam->id])?>" class="btn btn-primary">导入成绩</a>
<a href="<?=Url::toRoute(['respond','id'=>$exam->id])?>" class="btn btn-primary">班级对应</a>
<a href="<?=Url::toRoute(['clean','id'=>$exam->id])?>" class="btn btn-danger">清空成绩</a>
<?php }else{
$school = "市七中";
?>
<div class="btn-group">
    <?= Html::a('总体成绩', ['dash','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('平均及率', ['avg','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('班级进步', ['improve','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('达标统计', ['beyondline','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('班级成绩', ['bj','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
</div>
<?php
}
?>
<p></p>
<div class="row">
<div class="nav-tabs-custom">
  <!-- Nav tabs -->
 

  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">理科统计</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">文科统计</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">理科前10</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">文科前10</a></li>

  </ul>

<style type="text/css">
	th,td{
		text-align: center;
		font-size: 14px;
	}
</style>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active table-responsive" id="home">
    	<table class="table table-bordered table-hover ">
        <thead>
    		<tr>
    			<th>学校</th>
          <?php
            foreach ($lksubjects as $keys => $subject) {
              echo "<th colspan='2'>$subject_name[$subject]</th>";
            }
          ?>
    			<th>详细</th>
    		</tr>
      
    	<tr>
    		<td>@</td>
        <?php
            foreach ($lksubjects as $keys => $subject) {
              echo "<td>最高</td><td>平均</td>";
            }
          ?>
    		<td>@</td>
    	</tr>
    </thead>
    <tbody>
    	<?php
      //exit(var_export($schoolsAna));
           foreach ($schools as $key => $school) {
           	 echo "<tr><td>";
           	 echo $school;
           	 echo "</td><td>";
             foreach ($lksubjects as $keys => $subject) {
               echo $schoolsAna[$key]['max'][$subject];
               echo "</td><td>";
               echo $schoolsAna[$key]['avg'][$subject];
               echo "</td><td>";
            }
           	  echo "<a href='".Url::toRoute(['dash','school'=>$school,'exam'=>$exam->id])."'>$school</a>";
           	 echo "</td></tr>";
           }
    	?>
      </tbody>
    	</table>
    </div>
    <div role="tabpanel" class="tab-pane table-responsive" id="settings">
    	<table class="table table-bordered myTable2">
        <thead>
    		<tr>
    			<th>学校</th>
    			<?php
            foreach ($wksubjects as $keys => $subject) {
              echo "<th colspan='2'>$subject_name[$subject]</th>";
            }
          ?>
    			<th>详细</th>
    		</tr>
    	<tr>
    		<td>@</td>
    		<?php
            foreach ($wksubjects as $keys => $subject) {
              echo "<td>最高</td><td>平均</td>";
            }
          ?>
    		<td>@</td>
    	</tr>
      </thead>
      <tbody>
    	<?php
           foreach ($schools as $key => $school) {
           	 echo "<tr><td>";
           	 echo $school;
           	 echo "</td><td>";
             foreach ($wksubjects as $keys => $subject) {
               echo $schoolsAnaW[$key]['max'][$subject];
               echo "</td><td>";
               echo $schoolsAnaW[$key]['avg'][$subject];
               echo "</td><td>";
            }
           	echo "<a href='".Url::toRoute(['dash','school'=>$school,'exam'=>$exam->id])."'>$school</a>";
           	echo "</td></tr>";
           }
    	?>
      </tbody>
    	</table>
    </div>
    <div role="tabpanel" class="tab-pane table-responsive" id="profile">
	<table class='table table-bordered myTable3'>
 	<thead>
 	<tr>
 		<th>id</th>
 		<th>姓名</th>
 		<th>学校</th>
 		<th>班级</th>
 		<?php
      foreach ($lksubjects as $keys => $subject) {
        echo "<th>$subject_name[$subject]</th>";
      }
    ?>
 		<th>名次</th>
 	</tr>
 </thead>
 <tbody>
 <?php
 $scLike = array_slice($scLike,0,10);
foreach ($scLike as $key => $data) {
	echo "<tr><td>";
	echo $data->stu_id;
	echo "</td><td>";
	echo $data->stu_name;
	echo "</td><td>";
	echo $data->stu_school;
	echo "</td><td>";
	echo $data->stu_class;
	echo "</td><td>";
  foreach ($lksubjects as $keys => $subject) {
    echo $data->$subject;
    echo "</td><td>";
  }
	echo $data->mc;
	echo "</td></tr>";

}
 ?>
 </tbody>
 </table>
    </div>
    <div role="tabpanel" class="tab-pane table-responsive" id="messages">

  <table class='table table-bordered myTable4'>
 	<thead>
 	<tr>
 		<th>编号</th>
 		<th>姓名</th>
 		<th>学校</th>
 		<th>班级</th>
    <?php
      foreach ($wksubjects as $keys => $subject) {
        echo "<th>$subject_name[$subject]</th>";
      }
    ?>
 		<th>名次</th>
 	</tr>
 </thead>
 <tbody>
 <?php
 $scWenke = array_slice($scWenke,0,10);
foreach ($scWenke as $key => $data) {
	echo "<tr><td>";
	echo $data->stu_id;
	echo "</td><td>";
	echo $data->stu_name;
	echo "</td><td>";
	echo $data->stu_school;
	echo "</td><td>";
	echo $data->stu_class;
	echo "</td><td>";
  foreach ($wksubjects as $keys => $subject) {
    echo $data->$subject;
    echo "</td><td>";
  }
	echo $data->mc;
	echo "</td></tr>";

}
 ?>
 </tbody>
 </table>
</div>
</div>
</div>

</div>
</div>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

$('.myTable').DataTable({
  lengthChange:false,
  searching: false,
  paging:false,
} );
</script>


 	
 