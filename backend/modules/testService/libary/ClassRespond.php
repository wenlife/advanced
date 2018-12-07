<?php
namespace backend\modules\testService\libary;
use Yii;
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachYearManage;
use backend\modules\testService\models\Exam;
use backend\modules\testService\models\Classmap;

class ClassRespond{
	public $respond;
	function __construct(){
		////$reload = unserialize(file_get_contents('respond'));
		//$this->respond = $reload;

	}

	public static function writeRespond($school,$grade,$data)
	{
		foreach ($data as $key => $value) {
			$excel_class_name = $value;
			$system_class_id = $key;
			$mapModel = Classmap::find()->where(['school'=>$school,'excel_class_name'=>$excel_class_name])->one();
			if ($mapModel) {
				$mapModel->system_class_id = $system_class_id;
			}else{
				$mapModel = new Classmap();
				$mapModel->school = $school;
				$mapModel->grade = $grade;
				$mapModel->excel_class_name = $excel_class_name;
				$mapModel->system_class_id = $system_class_id;
				if(!$mapModel->save())
				{
					exit(var_export($mapModel->getErrors()));
				}
			}
		}
	}

	public function getTeachers($school,$exam)
	{
		//自动适配学期功能
		//$year_id = 1;
		if ($exam) {
		  $test = Exam::findOne($exam);
		  $testDate =  $test->date;
		  $year = TeachYearManage::find()->where(['and',['<','start_date',$testDate],['>','end_date',$testDate]])->one();
		 // exit(var_export($year->id));
		  if ($year) {
		  	$year_id = $year->id;//学期的ID
		  }else{
		  	return array();
		  }
		  
		}

		$map = Classmap::find()->where(['school'=>$school,'grade'=>$test->stu_grade])->all();
		$re = array();
		foreach ($map as $map_key => $map_value) {
			foreach (CommonFunction::getAllTeachDuty() as $subject => $subject_name) {
				$teach = TeachManage::find()
		                  ->where(['class_id'=>$map_value->system_class_id,'subject'=>$subject])
		                  ->andWhere(['year_id'=>$year_id])
		                  ->one();
			    $re[$map_value->excel_class_name][$subject] = ArrayHelper::getValue($teach,'teacher.name');
				
			}
		}
		//var_export($re);
			//	exit();
		return $re;

	}


	public function getLineTask($school,$exam,$type)
	{
		if ($exam) {
		  $test = Exam::findOne($exam);
		}
		$map = Classmap::find()->where(['school'=>$school,'grade'=>$test->stu_grade])->all();
		$re = array();
		foreach ($map as $keymap => $valuemap) {
			if ($type =='grade') {
				$re[$valuemap->excel_class_name]['task'] = $valuemap->sysClass->taskline->line1;
				$re[$valuemap->excel_class_name]['target'] = $valuemap->sysClass->taskline->line2;
			}elseif($type=='subject'){
				$re[$valuemap->excel_class_name]['task'] = $valuemap->sysClass->taskline->line3;
				$re[$valuemap->excel_class_name]['target'] = $valuemap->sysClass->taskline->line4;
			}
			
		}

		return $re;

	}


}



?>