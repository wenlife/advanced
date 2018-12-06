<?php
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
//常用参数初始化
$subjects = $Analysis->getSubjects();
$subjectTranslate = CommonFunction::getSubjects();
?>  

<table class="table table-bordered table-hover myTable" style="width:100%">
    <thead>
		<tr>
			<th>学校</th>
        <?php array_walk($subjects,function($value,$key){ echo "<th colspan='2'>$value</th>"; })?>
  			<th>详细</th>
		</tr>
    <tr><td>@</td>
      <?php array_walk($subjects,function($value,$key){ echo "<td>最高</td><td>平均</td>"; })?>
  		<td>@</td>
	   </tr>
</thead>
<tbody>
	<?php
       foreach ($Analysis->getSchoolList() as $school => $schoolAnalysis) {
       	 echo "<tr><td>";
       	 echo $school;
       	 echo "</td><td>";
         $max = $schoolAnalysis->getMax();
         $avg = $schoolAnalysis->getAvg();
         foreach ($subjects as $keys => $subject) {
           echo ArrayHelper::getValue($max,$subject);
           echo "</td><td>";
           echo ArrayHelper::getValue($avg,$subject);
           echo "</td><td>";
        }
       	echo "<a href='".Url::toRoute(['dash','school'=>$school,'exam'=>$schoolAnalysis->exam])."'>$school</a>";
       	echo "</td></tr>";
       }
	?>
  </tbody>
	</table>

 <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">前10名统计</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
        <table class='table table-bordered myTable3'>
          <thead>
          <tr><th>id</th><th>姓名</th><th>学校</th><th>班级</th>
          <?php array_walk($subjects,function($value,$key){echo "<th>$value</th>"; })?>
          <th>名次</th></tr>
         </thead>
         <tbody>
         <?php
         $scLike = array_slice($Analysis->getData(),0,10);
         $mc =1;
          foreach ($scLike as $key => $data) {
            echo "<tr><td>";
            echo $data['stu_id'];
            echo "</td><td>";
            echo $data['stu_name'];
            echo "</td><td>";
            echo $data['stu_school'];
            echo "</td><td>";
            echo $data['stu_class'];
            echo "</td><td>";
            foreach ($subjects as $keys => $subject) {
              echo $data[$subject];
              echo "</td><td>";
            }
            echo $mc++;
            echo "</td></tr>";

          }
         ?>
         </tbody>
         </table>
    
    </div>
  </div>