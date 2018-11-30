<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrrayHelper;

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
        	$schoolAnalysis[$school] = new SchoolAnalysis($this->exam,$this->type,$school,$this->except);
        }

        $this->schoolList = $schoolAnalysis;

        $this->init();

	}

	public function getSchoolList()
	{
	
		return $this->schooList();//$schoolAnalysis;
	}





}