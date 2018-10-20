<?php
  $sc = array_slice($sc,0,10);
  if($key = array_search('zf', $subjects)){
    // unset($subjects[$key]);
  }
  //生成姓名数组和成绩数组
  $zf = 0;
  foreach ($subjects as $keys => $subject) {
    $scArr = array();
    $nameArr = array();
    //将该科目的学生成绩组成一个数组
     foreach ($sc as $keyl => $scl) {
      $nameArr[] = $scl->stu_name.'/'.$scl->stu_class;
      $scArr[] = $scl->$subject;
     }
    //该科最高分学生成绩
    $maxStu = $subjectmax[$subject];
    //如果是总分，总分的最高分，则赋值为总分，否则总分最高分加上该科目的最高分，并将该科目最高分直接加到数组末尾
    if ($subject=='zf') {
      $scArr[] = $zf;
    }else{
      $zf += $maxStu->$subject;
      $scArr[] = $maxStu->$subject;
    }
    //标签数组
    $reName = $nameArr;//trim(json_encode($nameArr));
    //每个科目的分数数组
    $reTop[$subject] = $scArr;// trim(json_encode($scArr),'"');
    
    //点击变为单科的时候显示的X轴，在最末尾添加最高分的同学
    $teacherArr[$subject] = $nameArr;    
    $teacherArr[$subject][] = $maxStu->stu_name."/".$maxStu->stu_class;
    //在该位置，防止“最高分被添加到变化时候的X轴”
    $nameArr[] ="最高分";
  }
  
  if ($type=='lksc') {
    echo $this->render('chart_lk',[
        'xAx'=>$nameArr,
        'subjects'=>$subjects,
        'xData'=>$reTop,
        'xArray'=>$teacherArr,
        'title'=>'理科名次',
    ]);
  }else{
    echo $this->render('chart_wk',[
        'xAx'=>$nameArr,
        'subjects'=>$subjects,
        'xData'=>$reTop,
        'xArray'=>$teacherArr,
        'title'=>'文科名次',
    ]);
  }
  
?>


