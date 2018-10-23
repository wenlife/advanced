<?php
use yii\helpers\Url;
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;

if($key = array_search('zf', $subjects)){ unset($subjects[$key]);}    
foreach ($subjects as $keys => $subject) {
  $barArr = [];
  foreach ($bjs as $keybj => $bj) {
    $floatSc = ArrayHelper::getValue($scAna,"$keybj.float.$subject");
    $barArr[] = $floatSc?$floatSc*100:0;
    $teacherArr[$subject][] = $bj."/".ArrayHelper::getValue($resTeacher,"$bj.$subject");
}
 $reArr[$subject] = $barArr;//trim(json_encode($barArr));
}
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
             echo "<th colspan='4'>$subjects_name[$subject]</th>";
           }
          ?>
          <th colspan="2">总分</th>
        </tr>
      <tr>
        <td>@</td>
        <?php
           foreach ($subjects as $keys => $subject) {
             echo "<td>教师</td><td>上次</td><td>本次</td><td>进步</td>";
           }
          ?>
        <td>班主任</td>
      </tr>
  </thead>
  <tbody>
	<?php
  //exit(var_export($scAna));
       foreach ($bjs as $key => $bj) { 
       	 echo "<tr><td>";
       	 echo $bj;	
         foreach ($subjects as $keys => $subject) {
         echo "</td><td  style='border-left:1px dashed green'>";
         $color = ArrayHelper::getValue($scAna,"$key.float.$subject")>=0?'green':'red';                        
         echo ArrayHelper::getValue($resTeacher,"$bj.$subject");
         echo "</td><td>";
         echo ArrayHelper::getValue($scAna,"$key.avg_last.$subject");
         echo "</td><td>";
         echo ArrayHelper::getValue($scAna,"$key.avg.$subject");
         echo "</td><td class='$color'>";
         echo ArrayHelper::getValue($scAna,"$key.float.$subject");      
        }
        echo "</td><td>";
        echo ArrayHelper::getValue($resTeacher,"$bj.bzr");
       	echo "</td></tr>";
       }
	?>
  </tbody>
</table>
<?php
if ($type=='lk') {
 // var_export($teacherArr);
  //exit();
  echo $this->render('chart_lk',[
    'xAx'=> $bjs,//默认的x轴数据
    'subjects'=>$subjects, //需要展示的各个科目
    'xData'=>$reArr, //展示的数据
    'xArray'=>$teacherArr, //只剩单列的时候每个科目的X轴
    'title'=>'理科进步率表(放大100倍)',
  ]);
}else{
    echo $this->render('chart_wk',[
    'xAx'=> $bjs,//默认的x轴数据
    'subjects'=>$subjects, //需要展示的各个科目
    'xData'=>$reArr, //展示的数据
    'xArray'=>$teacherArr, //只剩单列的时候每个科目的X轴
    'title'=>'文科进步率表(放大100倍)',
  ]);

}
?>



