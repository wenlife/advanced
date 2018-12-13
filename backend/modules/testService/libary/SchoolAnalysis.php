<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrayHelper;
use yii\base\Exception;
// use backend\modules\testService\models\ScLike;
// use backend\modules\testService\models\ScWenke;

class SchoolAnalysis extends Analysis
{

	public $classList;
	public $school;
    public $lineScore;
    //public $examData;

     function __construct($exam,$type,$school,$except,$examData)
     {
     	parent::__construct($exam,$type,$except);

     	$this->school = $school;
       // $this->examData = $examData;

        $this->data = array_filter($examData,function($var)use($school){
            return $var['stu_school'] == $school;
        });

        $classList = ArrayHelper::getColumn($this->data,function($elment){
            return $elment['stu_class'];
        });

        $classList = array_unique($classList);
        sort($classList);

		foreach ($classList as $key => $class) {
        	$classAnalysis[$class]= new ClassAnalysis($exam,$type,$school,$class,$except,$this->data);
        }
        $this->classList = $classAnalysis;
        $this->init();

     }

    public function getSchoolSubjectScoreArray()
    {
        foreach ($this->subjects as $key => $subject) {
            $temp = null;
            $temp = ArrayHelper::getColumn($this->data,function($var)use($subject){
                return $var[$subject];
            });
            rsort($temp);
            array_filter($temp);
            $subjectScoreArray[$subject] = $temp;
        }

        return $subjectScoreArray;
    }

    public function getSchool()
    {
        return $this->school;
    }

     public function setClassList($classList)
     {
        $this->classList = $classList;
     }

     public function getClassList()
     {
        return $this->classList;
     }

     public function setLineScore($scorearr)
     {
        $this->lineScore = $scorearr;
     }

     public function getlineScore()
     {
        return $this->lineScore;
     }


     public function getClassAnalysis($class)
     {
        return $this->classList[$class];
     }

///////////////////////////////////////////////////////////////////////////////////////////////////////
}