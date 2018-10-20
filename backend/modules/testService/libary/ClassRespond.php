<?php
namespace backend\modules\testService\libary;
use Yii;
use backend\libary\CommonFunction;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachYearManage;
use backend\modules\testService\models\Exam;

class ClassRespond{
	public $respond;
	function __construct(){
		$reload = unserialize(file_get_contents('respond'));
		$this->respond = $reload;

	}

	public function writeRespond($data)
	{

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
		  $year_id = $year->id;
		}
		$respond = $this->respond;
		if (isset($respond[$school])) {
			$respond = $respond[$school];
		}else{
			return array();
		}
		
		$re = array();
		foreach ($respond as $class_db_id => $class_banji_name) {
			foreach (CommonFunction::getAllTeachDuty() as $subject => $subject_name) {
				$teach = TeachManage::find()
				                  ->where(['class_id'=>$class_db_id,'subject'=>$subject])
				                  ->andWhere(['year_id'=>$year_id])
				                  ->one();
			    if (isset($teach->teacher->name)) {
			    	$re[$class_banji_name][$subject] = $teach->teacher->name;
			    }
				
			}
		}
		//var_export($re);
			//	exit();
		return $re;

	}


}



?>