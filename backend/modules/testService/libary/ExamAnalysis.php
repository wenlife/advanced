<?php
namespace backend\modules\testService\libary;

use yii\base\Exception;
use yii\helpers\ArrayHelper;
use backend\modules\testService\models\Exam;

class ExamAnalysis extends Analysis
{

	public $schoolList;
	public $compareExam;

	function  __construct($exam,$type,$except=null)
	{
		parent::__construct($exam,$type,$except);

		$query = $this->model->find()->where(['test_id'=>$exam]);
		if ($except) {
	    	$query = $query->andWhere(['not like','note',$except]);
		}

		$this->data = $query->orderBy('zf desc')->asArray()->all();

		$this->schoolList = $query->select(['stu_school'])->orderBy('stu_school')->distinct()->column();
        $schoolList = $query->select(['stu_school'])->orderBy('stu_school')->distinct()->column();
        foreach ($schoolList as $key => $school) {
        	$schoolAnalysis[$school] = new SchoolAnalysis($exam,$type,$school,$except,$this->data);
        }

        $this->schoolList = $schoolAnalysis;

        $this->init();

	}

	public function getSchoolList()
	{
		//exit(var_export($this->data));

		return $this->schoolList;//$schoolAnalysis;
	}

	public function getSchoolAnalysis($school)
	{
		if (array_key_exists($school, $this->schoolList)) {
			return $this->schoolList[$school];
		}else{

			throw new Exception("school name can not find!", 1);
			
		}
		
	}


}