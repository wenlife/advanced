<?php
use yii\helpers\Url;
use backend\libary\CommonFunction;

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
<table class="table table-bordered table-hover dataTable" style="width: 100%">
  <thead>
        <tr>
          <th>班级</th>
          <?php
          $subjects_name = CommonFunction::getSubjects();
           foreach ($subjects as $keys => $subject) {
             echo "<th colspan='3'>";
             echo $subjects_name[$subject];
             echo "/";
             echo $uponline['line'][$subject];
             echo "</th>";
           }

          ?>
          <th colspan="2">总分</th>
        </tr>
      <tr>
        <td>@</td>
        <?php
           foreach ($subjects as $keys => $subject) {
             echo "<td>教师</td><td>达标</td><td>有效</td>";
           }
          ?>
        <td>教师</td><td>进步率</td>
      </tr>
</thead>
<tbody>
	<?php
  //exit(var_export($scAna));
       foreach ($bjs as $key => $bj) {
        
       	 echo "<tr><td>";
       	 echo $bj;
       	 echo "</td><td>";
         foreach ($subjects as $keys => $subject) {   
        // $color = $scAna[$key]['float'][$subject]>=0?'green':'red';                     
         echo isset($resTeacher[$bj][$subject])?$resTeacher[$bj][$subject]:null;
         echo "</td><td>";
         echo $uponline[$bj][$subject]['uponline'];
         //echo $scAna[$key]['avg'][$subject];
         echo "</td><td>";
         echo $uponline[$bj][$subject]['realuponline'];
         echo "</td><td>";
        }
        //echo $resTeacher[$bj]['bzr'];
        echo isset($resTeacher[$bj]['bzr'])?$resTeacher[$bj]['bzr']:null;
        //$color = $scAna[$key]['float']['zf']>=0?'green':'red';
        echo "</td><td>";
       	//echo  $uponline[$bj]['zf']['uponline'];
        // echo "</td><td>";
       	// echo "";
       	echo "</td></tr>";
       }
	?>
</tbody>
</table>


