<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrayHelper;
use backend\modules\testService\models\Exam;
use backend\modules\testService\models\ScLike;
use backend\modules\testService\models\ScWenke;

class Analysis
{
	public $exam;
	public $type;
	public $except;
	public $model;
	public $data;
	public $subjects;
    public $lkSubject = ['yw','ds','yy','wl','hx','sw','zf'];//理科科目数组
	public $wkSubject = ['yw','ds','yy','zz','ls','dl','zf'];//文科科目数组
	public $avg;
	public $preAvg;
	public $max;
	public $pass;
	public $compareExam;



	public function __construct($exam,$type,$except=null)
	{
		$this->exam = $exam;
		$this->type = $type;
		$this->except = $except;
		switch ($type) {
			case 'lk':
				$this->model = new ScLike();
				$this->subjects = $this->lkSubject;
				break;
			case 'wk':
                $this->model = new Scwenke();
                $this->subjects = $this->wkSubject;
			    break;
			default:
				exit('Type var was not set in ExamAnalysis');
				break;
		}

		// foreach ($this->subjects as $key => $subject) {

		// 	$this->$subject = new SubjectEntity($subject);

		// }
	}

	public function init()
	{

		foreach ($this->subjects as $key => $subject) {  
		 	$subjectScore = ArrayHelper::getColumn($this->data,function($element)use($subject){
		 		//exit(var_export($element));
		 		return isset($element[$subject])?$element[$subject]:0;
		 	});
		 	$subjectScore =  array_filter($subjectScore);
		 	$this->avg[$subject] = count($subjectScore)==0?0:round(array_sum($subjectScore)/count($subjectScore),2);
		 	$this->max[$subject] = count($subjectScore)?max($subjectScore):0;
		 	// $this->$subject->avg = count($subjectScore)==0?0:array_sum($subjectScore)/count($subjectScore);
		    // $this->$subject->avg = max($subjectScore);
		 	$mainSubject = ['yw','ds','yy'];
		 	$passLine = in_array($subject,$mainSubject)?90:60;
		 	$passArray = array_filter($subjectScore,function($var)use($passLine){return $var>=$passLine;});
		 	$this->pass[$subject] =  count($subjectScore)?count($passArray)/count($subjectScore):0;
		 	// $this->$subject->pass = count($passArray)/count($subjectScore);

		}

	}

	public function getExamModel()
	{
		return Exam::findOne($this->exam);
	}

	public function setPreAvg($avg)
	{
		$this->preAvg = $avg;
	}

	public function getPreAvg()
	{
		return $this->preAvg;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getAvg()
	{
		return $this->avg;
	}
	public function getMax()
	{
		return $this->max;
	}
	public function getPass()
	{
		return $this->pass;
	}

	public function getSubjects()
	{
		return $this->subjects;
	}

	public function getCompareExam()
	{
		return Exam::findOne($this->exam)->compare;
	}


/////////////////////////////////////////////////////////////////////
}
