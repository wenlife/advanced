<?php

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
	foreach ($classList as $class => $classAnalysis) {
		echo '-'.$class.'-';
		var_export($classAnalysis->getAvg());
		echo "<br>";
		echo '-'.$class.'-';
		var_export($classAnalysis->pass);
		echo "<br>";
		var_export($classAnalysis->getImprove());
		echo "<br>";
	}
}