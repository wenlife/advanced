<?php
use yii\helpers\Url;
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;

if($key = array_search('zf', $subjects)){
  unset($subjects[$key]);
}    
foreach ($subjects as $keys => $subject) {
 $barArr = [];
  foreach ($bjs as $key => $value) {
      $barArr[] = ArrayHelper::getValue($scAna,$key.'.avg.'.$subject);
}
 $reArr[$subject] = $barArr;//trim(json_encode($barArr));
}
?>
<style type="text/css">
  td.gray{
    background-color: gray;
  }
</style>
<div class="table-responsive">

<table class="table table-bordered table-hover dataTable" style="width: 100%">
  <thead>
    		<tr>
    			<th colspan="2">班级</th>
          <?php
           foreach ($subjects as $keys => $subject) {
             $subjects_name = CommonFunction::getSubjects();
             echo "<th colspan='3'>";
             echo  ArrayHelper::getValue($subjects_name,$subject);
             echo "/";
             echo  ArrayHelper::getValue($avgSchool,$subject);
             echo "</th>";
           }
          ?>
    			<th colspan="2">总分</th>
    		</tr>
    	<tr>
        <td>排序</td>
    		<td>@</td>
        <?php
           foreach ($subjects as $keys => $subject) {
             echo "<td>教师</td><td>平均</td><td>及率</td>";
           }

          ?>
    		<td>教师</td><td>平均</td>
    	</tr>
  </thead>
  <tbody>
<?php
$i = 1;
   foreach ($bjs as $key => $bj) {
     
   	 echo "<tr><td>";
     echo $i++;
     echo "</td><td>";
   	 echo $bj; 
     foreach ($subjects as $keys => $subject) {
      //$color = $keys%2==0?'grey':'white';   
     echo '</td><td style="border-left:1px dashed green">';
     echo ArrayHelper::getValue($resTeacher,"$bj.$subject");    
     echo "</td><td>";
     echo number_format(ArrayHelper::getValue($scAna,"$key.avg.$subject"),2);
     echo "</td><td>";
     echo number_format(ArrayHelper::getValue($scAna,"$key.pass.$subject"),2);  
    }
    echo "</td><td>";
    echo ArrayHelper::getValue($resTeacher,"$bj.bzr");
    echo "</td><td>";
    echo ArrayHelper::getValue($scAna,"$key.avg.zf");
   // echo "</td><td>";
   //	echo "<a href='".Url::toRoute(['bj','school'=>$school,'exam'=>$exam,'bj'=>$bj])."'>$bj</a>";
   	echo "</td></tr>";
   }
?>
  </tbody>
</table>

</div>

<div class="charts">
<?php
  foreach ($subjects as $key => $subject) {
    foreach ($bjs as $keybj => $bj) {
//      if (isset($resTeacher[$bj][$subject])) {
       $teacherArr[$subject][] = $bj."/".ArrayHelper::getValue($resTeacher,"$bj.$subject");
      // }else{
      //   $teacherArr[$subject][] = 'NotSet';
      // }
    }
  }
if ($type=="lk") {
  echo $this->render('chart_lk',[
      'xAx'=>$bjs,
      'subjects'=>$subjects,
      'xData'=>$reArr,
      'xArray'=>$teacherArr,
      'title'=>'理科平均分'
    ]);
}else{
  echo $this->render('chart_wk',[
    'xAx'=>$bjs,
    'subjects'=>$subjects,
    'xData'=>$reArr,
    'xArray'=>$teacherArr,
    'title'=>'文科平均分',
  ]);
}

?>
</div>


  