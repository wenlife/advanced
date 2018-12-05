<?php
$this->title = 'Data Test';
$schoolList = $data->getSchoolList();

// $data2 = array_filter($data->data,function($var){
// 	return $var['stu_school']=="市七中"&&$var['stu_class']=="15班";
// });

// var_export($data2);


foreach ($schoolList as $school => $schoolAnalysis) {
	echo $school.'-';
	//var_dump($schoolAnalysis);
	var_export($schoolAnalysis->getAvg());
	echo "<br>";
	$classList = $schoolAnalysis->getClassList();
 $i =0;
	foreach ($classList as $class => $classAnalysis) {
		echo '平均分-'.$class.'-';
		var_export($classAnalysis->getAvg());
		echo "<br>";
		echo '及格率-'.$class.'-';
		var_export($classAnalysis->pass);
		echo "<br>";
		echo '进步率-'.$class.'-';
		var_export($classAnalysis->getImprove());
		echo "<br>";
		echo '达标率-'.$class.'-';
		var_export($classAnalysis->getBeyondline());
		echo "<br>";
		echo '教师-'.$class.'-';
		var_export($classAnalysis->getTeachers());
		echo "<br>";
	    echo '第'.++$i.'次进行';
	    echo "<hr>";
		
	}
}