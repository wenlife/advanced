<?php
use yii\helpers\Url;
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;

$subjects = $Analysis->getSubjects();
$subjects_name = CommonFunction::getSubjects();
?>

<div class="table-responsive">
<table class="table table-bordered table-hover dataTable" style="width: 100%">
  <thead>
        <tr>
          <th>班级</th>
          <?php
          $avgGrade = $Analysis->getAvg();
          $preAvgGrade = $Analysis->getPreAvg();
            foreach ($subjects as $key => $subject) {
              echo "<th colspan='4'>";
              echo ArrayHelper::getValue($subjects_name,"$subject");
              echo "(".ArrayHelper::getValue($preAvgGrade,"$subject")."/".ArrayHelper::getValue($avgGrade,"$subject").")";
              echo "</th>";
            }

          ?>
        </tr>
      <tr>
        <td>@</td>
        <?php array_walk($subjects,function($value,$key){echo "<td>教师</td><td>上次</td><td>本次</td><td>进步</td>";})?>
      </tr>
  </thead>
  <tbody>
	<?php
     foreach ($Analysis->getClassList() as $class => $classAnalysis) {
       $teachers = $classAnalysis->getTeachers();
       $improve = $classAnalysis->getImprove();
       $avg = $classAnalysis->getAvg(); 
       $preAvg = $classAnalysis->getPreAvg();
     	 echo "<tr><td>";
     	 echo $class;	
       foreach ($subjects as $keys => $subject) {
       echo "</td><td  style='border-left:1px dashed green'>";
       $color = ArrayHelper::getValue($improve,"$subject")>=0?'green':'red';                        
       echo $subject=='zf'?ArrayHelper::getValue($teachers,"bzr"):ArrayHelper::getValue($teachers,"$subject");
       echo "</td><td>";
       echo ArrayHelper::getValue($preAvg,"$subject");
       echo "</td><td>";
       echo ArrayHelper::getValue($avg,"$subject");
       echo "</td><td class='$color'>";
       echo ArrayHelper::getValue($improve,"$subject"); 
       
 
      }
      
     	echo "</td></tr>";
     }
	?>
  </tbody>
</table>
</div>
<div class="charts">
<?php
// if ($type=='lk') {
//  // var_export($teacherArr);
//   //exit();
//   echo $this->render('chart_lk',[
//     'xAx'=> $bjs,//默认的x轴数据
//     'subjects'=>$subjects, //需要展示的各个科目
//     'xData'=>$reArr, //展示的数据
//     'xArray'=>$teacherArr, //只剩单列的时候每个科目的X轴
//     'title'=>'理科进步率表(放大100倍)',
//   ]);
// }else{
//     echo $this->render('chart_wk',[
//     'xAx'=> $bjs,//默认的x轴数据
//     'subjects'=>$subjects, //需要展示的各个科目
//     'xData'=>$reArr, //展示的数据
//     'xArray'=>$teacherArr, //只剩单列的时候每个科目的X轴
//     'title'=>'文科进步率表(放大100倍)',
//   ]);

// }
?>
</div>



