<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrrayHelper;
use backend\modules\testService\models\Exam;
// use backend\modules\testService\models\ScLike;
// use backend\modules\testService\models\ScWenke;

class CompareAnalysis
{
	public $exam_id;
	public $typel;
	public $school;
	public $except;
	public $thisSchoolAnalysis;
	function __construct(SchoolAnalysis $schoolAnalysis)
	{
		$this->exam_id = $schoolAnalysis->exam;
		$this->type = $schoolAnalysis->type;
		$this->school = $schoolAnalysis->school;
		$this->except = $schoolAnalysis->except;
		$thisSchoolAnalysis = $schoolAnalysis;

	}

	public function getImprove()
	{
		$examModel = Exam::findOne($this->exam_id);
		$compareExam_id = $examModel->compare;

		$thisGradeAvg = 0;
		$thisClassAvg = 0;
		$preGradeAvg =0;
		$preClassAvg = 0;

		//$thisSchoolAnalysis = new SchoolAnalysis($this->exam_id,$this->type,$this->school,$this->except);
		$preSchoolAnlysis = new SchoolAnalysis($compareExam_id,$this->type,$this->school,$this->except);

		$thisClassList = $thisSchoolAnalysis->getClassList();
		$preClassList = $preSchoolAnlysis->getClassList();
		$thisGradeAvg = $thisSchoolAnalysis->getAvg();
		$preGradeAvg = $preSchoolAnlysis->getAvg();
		unset($thisSchoolAnalysis);
        unset($preSchoolAnlysis);

		$improve = array();
		if ($thisGradeAvg&&$preGradeAvg) {
			foreach ($thisClassList as $class => $classAnalysis) {
				$thisClassAvg = $classAnalysis->getAvg();
				$preClassAvg = $classAnalysis->getAvg();
				foreach ($classAnalysis->getSubjects() as $key => $subject) {
					$improve[$class][$subject] = $thisClassAvg[$subject]/$thisGradeAvg[$subject]-$preClassAvg[$subject]/$preGradeAvg[$subject];
				}
				
			}
		}
		
        return $improve;

	}
}