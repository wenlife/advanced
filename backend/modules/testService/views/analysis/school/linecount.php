<?php
use yii\helpers\Url;
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;
$subjects = $Analysis->getSubjects();
$exam = $Analysis->getExamModel();
$subjects_name = CommonFunction::getSubjects();
?>
<div class="table-responsive">
<table class="table table-bordered table-hover" style="width: 100%">
  <thead>
    <tr>
      <th>班级</th>
      <th colspan="1">指标</th>
      <?php

       $lineScore = $Analysis->getLineScore();
       $avgGrade = $Analysis->getAvg();   
       foreach ($subjects as $keys => $subject) {
         echo "<th colspan='4'>";
         echo  ArrayHelper::getValue($subjects_name,"$subject");
         echo "(达标：".ArrayHelper::getValue($lineScore,"$subject")."/".ArrayHelper::getValue($avgGrade,"$subject").")";
         echo "</th>";
       }

      ?>
      
    </tr>
  <tr>
    <td>@</td>
    <td>设定</td>
    <?php array_walk($subjects,function($value,$key){echo "<td>教师</td><td>平均</td><td>达标</td><td>有效</td>";}) ?> 
  </tr>
</thead>
<tbody>
<?php
   foreach ($Analysis->getClassList() as $class => $classAnalysis) {
     $target = $classAnalysis->getTarget();
     $beyondline = $classAnalysis->getBeyondline();
     $teachers = $classAnalysis->getTeachers();
   	 echo "<tr><td>";
   	 echo $class;
   	 echo "</td><td>";
     echo $target;

     $avg = $classAnalysis->getAvg();

     foreach ($subjects as $keys => $subject) { 
  
      $real = ArrayHelper::getValue($beyondline,"$subject.realbeyondline");
      $subjectTask = ArrayHelper::getValue($beyondline,"$subject.beyondline");
      $sum_num = $subjectTask-$target;
      if ($sum_num>0) {
        $sub = "<sub class='text-success'>$sum_num</sub>";
      }elseif($sum_num==0){
        $sub = '';
      }else{
         $sub = "<sub class='text-danger'>$sum_num</sub>";
      }
     echo '</td><td style="border-left:1px dashed green">'; 
    // $color = $scAna[$key]['float'][$subject]>=0?'green':'red';
     if ($subject=='zf') {
       echo  ArrayHelper::getValue($teachers,"bzr"); 
      }                     
     echo  ArrayHelper::getValue($teachers,"$subject");   
     echo "</td><td>";
     echo ArrayHelper::getValue($avg,"$subject");
     echo "</td><td>";
     echo  $subjectTask.$sub; //$uponline[$bj][$subject]['uponline'];
     echo "</td><td>";
     echo  $real;   //$uponline[$bj][$subject]['realuponline'];
     
    }
    echo "</tr>";
   }
?>
</tbody>
</table>
</div>


