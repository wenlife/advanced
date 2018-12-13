<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrayHelper;
use backend\modules\testService\models\Exam;
use backend\modules\testService\models\Classmap;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachYearManage;
use backend\modules\guest\models\Teachers;
//use backend\modules\testService\models\Exam;

class ClassAnalysis extends Analysis
{
    public $school;
	public $class;
	//public $schoolData;
	public $improve;
	public $order;
	public $teacher;
	public $beyondline;
	public $target;

	function __construct($exam,$type,$school,$class,$except,$schoolData)
	{
		parent::__construct($exam,$type,$except);

		$this->school = $school;
		$this->class = $class;
		//$this->schoolData = $schoolData;

	    $this->data = array_filter($schoolData,function($var)use($class){
            return $var['stu_class'] == $class;
        });

        $this->init();

	}

	public function getSchool()
	{
		return $this->school;
	}

	public function getClass()
	{
		return $this->class;
	}

	public function setOrder($order)
	{
		$this->order = $order;
	}

	public function getOrder()
	{
		return $this->order;
	}


	public function setImprove($improve)
	{
		$this->improve = $improve;
	}

	public function getImprove()
	{
		return $this->improve;
	}

	public function setTarget($target)
	{
		$this->target = $target;
	}

	public function getTarget()
	{
		return $this->target;
	}

	public function setBeyonline($beyondline)
	{
		$this->beyondline = $beyondline;
	}

	public function getBeyondline()
	{
		return $this->beyondline;
	}

	public function getTeachers()
	{
		if ($this->exam) {
		  $test = Exam::findOne($this->exam);
		  $testDate =  $test->date;
		  $year = TeachYearManage::find()->where(['and',['<','start_date',$testDate],['>','end_date',$testDate]])->one();
		 // exit(var_export($year->id));
		  if ($year) {
		  	$year_id = $year->id;//学期的ID
		  }else{
		  	return array();
		  }
		  
		}

		$map = Classmap::find()->where(['school'=>$this->school,'grade'=>$test->stu_grade,'excel_class_name'=>$this->class])->one();
		//$re = array();
		$teach = TeachManage::find()
		          ->select(['subject','teacher_id'])
		        //  ->leftJoin('Teachers AS t','t.id = teacher_id')
                  ->where(['class_id'=>$map->system_class_id,'year_id'=>$year_id])
                  //->andWhere(['year_id'=>$year_id])
                  ->indexBy('subject')
                  ->all();

        $teachArr = ArrayHelper::map($teach,'subject','teacher.name');

        // var_export($teachArr);
        // exit();
		//var_export($re);
			//	exit();
		return $teachArr;
		//$teachers = ClassRespond::getTeachers($this->school,$this->exam);

		//return isset($teachers[$this->class])?$teachers[$this->class]:null;
	}

  


}