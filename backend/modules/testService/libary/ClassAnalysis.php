<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrrayHelper;
//use backend\modules\testService\models\Exam;
// use backend\modules\testService\models\ScLike;
// use backend\modules\testService\models\ScWenke;

class ClassAnalysis extends Analysis
{
    public $school;
	public $class;
	//public $improve;

	function __construct($exam,$type,$school,$class,$except=null)
	{
		parent::__construct($exam,$type,$except);

		$this->school = $school;
		$this->class = $class;

     	$query = $this->model->find()->where(['test_id'=>$exam,'stu_school'=>$school,'stu_class'=>$class]);
     	if ($except) {
	    	$query = $query->andWhere(['not like','note',$except]);
		}

		$this->data = $query->orderBy('zf desc')->asArray()->all();

        $this->init();

	}

	// public function getImprove()
	// {
 //        $compare = Exam::findOne($this->exam)->compare;

 //        $thisSchoolAnalysis = new SchoolAnalysis($this->exam,$this->type,$this->school,$this->except);
 //        $preSchoolAnalysis = new SchoolAnalysis($compare,$this->type,$this->school,$this->except);
 //        $preClassAnalysis = new ClassAnalysis($compare,$this->type,$this->school,$this->class,$this->except);
 //        $thisClassAvg = $this->getAvg();
 //       	$thisGradeAvg = $thisSchoolAnalysis->getAvg();
	// 	$preGradeAvg = $preSchoolAnalysis->getAvg();
	// 	$preClassAvg = $preClassAnalysis->getAvg();

	// 	foreach ($this->subjects as $key => $subject) {
 //          // $improve[$subject] = $thisClassAvg[$subject]/$thisGradeAvg[$subject]-$preClassAvg[$subject]/$preGradeAvg[$subject];
	// 	}


        
 //        $queryNowGrade = $this->model->find()->where(['test_id'=>$this->exam,'stu_school'=>$this->school]);
 //        $queryPreGrade = $this->model->find()->where(['test_id'=>$compare,'stu_school'=>$this->school]);
 //        $queryPreClass = $this->model->find()->where(['test_id'=>$compare,'stu_school'=>$this->school,'stu_class'=>$this->class]);
 //        if ($this->except) {
	//     	$queryNowGrade = $query->andWhere(['not like','note',$except]);
	//     	$queryPreGrade = $query->andWhere(['not like','note',$except]);
	//     	$queryPreClass = $query->andWhere(['not like','note',$except]);
	// 	}
	// 	$thisClassAvgArray = $this->getAvg();
	// 	foreach ($this->subjects as $key => $subject) {
	// 		$thisGradeAvg = $queryNowGrade->avg($subject);
	// 		$preGradeAvg = $queryPreGrade->avg($subject);
	// 		$preClassAvg = $queryPreClass->avg($subject);
	// 		$improve[$subject] = $thisClassAvgArray[$subject]/$thisGradeAvg-$preClassAvg/$preGradeAvg;
	// 	}
	// 	$this->improve = $improve;
	// 	return $improve;
	// }


}