<?php
use yii\helpers\Url;
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;

if($key = array_search('zf', $subjects)){
  unset($subjects[$key]);
}    
// foreach ($subjects as $keys => $subject) {
//  $barArr = [];
//   foreach ($bjs as $key => $value) {
//       $barArr[] = $scAna[$key]['avg'][$subject];
// }
//  $reArr[$subject] = trim(json_encode($barArr));
// }
?>
<style type="text/css">
  .green{
    color:green;
  }
  .red{
    color:red;
  }
</style>
<div class="table-responsive">
<table class="table table-bordered table-hover dataTable" style="width: 100%">
  <thead>
        <tr>
          <th>班级</th>
          <th colspan="2">指标</th>
          <?php
          $subjects_name = CommonFunction::getSubjects();
           foreach ($subjects as $keys => $subject) {
             echo "<th colspan='3'>";
             echo  ArrayHelper::getValue($subjects_name,"$subject");//           $subjects_name[$subject];
             echo "/";
             echo  ArrayHelper::getValue($uponline,"line.$subject");                      //$uponline['line'][$subject];
             echo "</th>";
           }

          ?>
          
        </tr>
      <tr>
        <td>@</td>
        <td>任务</td><td>目标</td>
        <?php
           foreach ($subjects as $keys => $subject) {
             echo "<td>教师</td><td>达标</td><td>有效</td>";
           }
          ?>
        
      </tr>
</thead>
<tbody>
	<?php
  //exit(var_export($scAna));
       foreach ($bjs as $key => $bj) {

        $task = ArrayHelper::getValue($resTask,"$bj.task");
       	 echo "<tr><td>";
       	 echo $bj;
       	 echo "</td><td>";
         echo $task;
         echo "</td><td>";
         echo ArrayHelper::getValue($resTask,"$bj.target");
         foreach ($subjects as $keys => $subject) {  
          $real = ArrayHelper::getValue($uponline,"$bj.$subject.realuponline");
          $sum_num = $real-$task;
          if ($sum_num>0) {
            $sub = "<sub class='text-success'>$sum_num</sub>";
          }elseif($sum_num==0){
            $sub = '';
          }else{
             $sub = "<sub class='text-danger'>$sum_num</sub>";
          }
         echo "</td><td>"; 
        // $color = $scAna[$key]['float'][$subject]>=0?'green':'red';                     
         echo  ArrayHelper::getValue($resTeacher,"$bj.$subject");   // isset($resTeacher[$bj][$subject])?$resTeacher[$bj][$subject]:null;
         echo "</td><td>";
         echo  ArrayHelper::getValue($uponline,"$bj.$subject.uponline"); //$uponline[$bj][$subject]['uponline'];
         //echo $scAna[$key]['avg'][$subject];
         echo "</td><td>";
         echo  $real.$sub;   //$uponline[$bj][$subject]['realuponline'];
         
        }
        echo "</tr>";
        //echo $resTeacher[$bj]['bzr'];
         //echo  ArrayHelper::getValue($resTeacher,"$bj.brz");      //isset($resTeacher[$bj]['bzr'])?$resTeacher[$bj]['bzr']:null;
        //$color = $scAna[$key]['float']['zf']>=0?'green':'red';
        
       	//echo  $uponline[$bj]['zf']['uponline'];
        // echo "</td><td>";
       	// echo "";
       	//echo "</td></tr>";
       }
	?>
</tbody>
</table>
</div>


