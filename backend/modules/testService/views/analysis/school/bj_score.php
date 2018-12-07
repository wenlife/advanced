<?php
use yii\helpers\ArrayHelper;

$sc = array_slice($Analysis->getData(),0,10);
//最高分数组，添加到学生名字和成绩数组中
$max = $Analysis->getMax();
//将总分最高分替换为全科最高分;
$maxZfScore = array_sum($max)-$max['zf'];
$max['zf'] = $maxZfScore;

//生成用于x轴的名称学生名称显示
//==============nameArr======================================
$nameArr = array();
array_map(function($item)use(&$nameArr){
  array_push($nameArr,$item['stu_name'].'/'.$item['stu_class']);
},$sc);
//最高分的学生姓名应该是否添加？
array_push($nameArr,'最高分');
//生成每科的成绩数组
//===================scArr====teacherArr========================
//$scArr = array();
foreach ($Analysis->getSubjects() as $key => $subject) {
    $scArr[$subject] = ArrayHelper::getColumn($sc,$subject);
    array_push($scArr[$subject],$max[$subject]);
    $teacherArr[$subject] = $nameArr;   
}  
//点击变为单科的时候显示的X轴，在最末尾添加最高分的同学
 
//$teacherArr[$subject][] = $maxStu->stu_name."/".$maxStu->stu_class;
//在该位置，防止“最高分被添加到变化时候的X轴”


if ($type=='lksc') {
  echo $this->render('chart_lk',[
      'xAx'=>$nameArr,
      'subjects'=>$Analysis->getSubjects(),
      'xData'=>$scArr,
      'xArray'=>$teacherArr,
      'title'=>'理科名次',
  ]);
}else{
  echo $this->render('chart_wk',[
      'xAx'=>$nameArr,
      'subjects'=>$Analysis->getSubjects(),
      'xData'=>$scArr,
      'xArray'=>$teacherArr,
      'title'=>'文科名次',
  ]);
}
  
?>


