<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrayHelper;
use backend\modules\testService\models\Exam;
// use backend\modules\testService\models\ScLike;
// use backend\modules\testService\models\ScWenke;

class CompareAnalysis
{
   public $thisAnalysis;
   public $compareAnalysis;

   function __construct(SchoolAnalysis $thisSchoolAnalysis,SchoolAnalysis $compareSchoolAnalysis)
   {
   	  $this->thisAnalysis = $thisSchoolAnalysis;
   	  $this->compareAnalysis = $compareSchoolAnalysis;
   }

   public function generateImprove()
   {
   	  $classList    = $this->thisAnalysis->getClassList();
   	  $preGradeAvg  = $this->compareAnalysis->getAvg();
      $thisGradeAvg = $this->thisAnalysis->getAvg();
      $this->thisAnalysis->setPreAvg($preGradeAvg);
    	foreach ($classList as $class => $classAnalysis) 
    	{
    		$improve       = null;
	    	$thisClassAvg  = $classAnalysis->getAvg();
	    	$preClassAvg   = $this->compareAnalysis->getClassAnalysis($class)->getAvg();
	    	foreach ($this->thisAnalysis->getSubjects() as $key => $subject) {
	    		$varunder1 = ArrayHelper::getValue($thisGradeAvg,$subject);
	    		$varunder2 = ArrayHelper::getValue($preGradeAvg,$subject);
	    		$varup1    = ArrayHelper::getValue($thisClassAvg,$subject);
	    		$varup2    = ArrayHelper::getValue($preClassAvg,$subject);
	    		if ($varunder2&&$varunder1) {
	    			$improve[$subject] = round($varup1/$varunder1 - $varup2/$varunder2,3);
	    		}
	    	}

	    	$classAnalysis->setImprove($improve);
        $classAnalysis->setPreAvg($preClassAvg);

	    	$classList[$class] = $classAnalysis;
	    }



	    $this->thisAnalysis->setClassList($classList);
	  //  return $this->thisAnalysis;
   }

   public function generateOrder()
   {
   	   $orderThis = $this->thisAnalysis->getSchoolSubjectScoreArray();
   	   $orderPre  = $this->compareAnalysis->getSchoolSubjectScoreArray();
   	   $classList = $this->thisAnalysis->getClassList();
   	   foreach ($classList as $class => $classAnalysis) {
   	   	    $order = null;
   	   	    foreach ($classAnalysis->getData() as $key_student => $studentScore) {
   	   	  	    foreach ($this->thisAnalysis->getSubjects() as $key_subject => $subject) {
   	   	  	  		$stuid = ArrayHelper::getValue($studentScore,'stu_id');

                    $order[$stuid][$subject]['this']  = array_search(ArrayHelper::getValue($studentScore,$subject),$orderThis[$subject])+1;
                    $order[$stuid][$subject]['pre']   = array_search(ArrayHelper::getValue($studentScore,$subject),$orderPre[$subject])+1;
                    $order[$stuid][$subject]['float'] = $order[$stuid][$subject]['this']-$order[$stuid][$subject]['pre']; 
   	   	  	    }
   	   	  }
        $classAnalysis->setOrder($order);
        $classList[$class] = $classAnalysis;
   	   }

   	   $this->thisAnalysis->setClassList($classList);
   	   //return $this->thisAnalysis;
   }

   public function getAnalysis()
   {
   	 return $this->thisAnalysis;
   }

	
}