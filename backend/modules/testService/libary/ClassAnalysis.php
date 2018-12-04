<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrayHelper;
//use backend\modules\testService\models\Exam;

class ClassAnalysis extends Analysis
{
    public $school;
	public $class;
	public $schoolData;
	public $improve;
	public $order;
	public $teacher;
	public $beyondline;

	function __construct($exam,$type,$school,$class,$except,$schoolData)
	{
		parent::__construct($exam,$type,$except);

		$this->school = $school;
		$this->class = $class;
		$this->schoolData = $schoolData;

	    $this->data = array_filter($schoolData,function($var)use($class){
            return $var['stu_class'] == $class;
        });

        $this->init();

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

	public function setBeyonline($beyondline)
	{
		$this->beyondline = $beyondline;
	}

	public function getBeyonline()
	{
		return $this->beyondline;
	}

	public function getTeachers()
	{
		$teachers = ClassRespond::getTeachers($this->exam,$this->school);

		return isset($teachers[$this->class])?$teachers[$this->class]:null;
	}

  


}