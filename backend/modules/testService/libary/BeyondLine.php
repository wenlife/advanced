<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrayHelper;
use yii\base\Exception;
use backend\modules\testService\models\Exam;
use backend\modules\school\models\TeachClass;
use backend\modules\testService\models\Taskline;

class BeyondLine
{
	public $exam;
	public $examType;
	public $grade;
	public $school;
	public $except;
	public $classType;
	//public $model;
	public $subjects;
	public $SchoolData;

	// public function __construct($exam,$school,$classType,$except)
	// {
	// 	$this->exam = $exam;
	// 	$this->school = $school;
	// 	$this->except = $except;
	// 	$test = Exam::findOne($exam);

	// 	$this->grade = $test->stu_grade;
	// 	$this->examType = $test->type;
	// 	switch ($classType) {
	// 		case 'lk':
	// 			$this->model = new ScLike();
	// 			$this->subjects = $this->lkSubject;
	// 			break;
	// 		case 'wk':
 //                $this->model = new Scwenke();
 //                $this->subjects = $this->lkSubject;
	// 		    break;
	// 		default:
	// 			throw new Exception("Type var was not set in Beyondline", 1);	
	// 			break;
	// 	}
	// }
    public function __construct(SchoolAnalysis $SchoolData)
	{
		$this->SchoolData = $SchoolData;
		$this->exam = $SchoolData->exam;
		$this->school =$SchoolData->school;
		$this->except =$SchoolData->except;
		$this->classType= $SchoolData->type;
		$this->subjects = $SchoolData->subjects;

        $test = Exam::findOne($SchoolData->exam);
		$this->grade = $test->stu_grade;
		$this->examType = $test->type;

	}

    /**
     * @param  line1 line2 line3 line4
     * @return linesum该线的总人数
     */
	public function getLineSum($line)
	{
		$lineArr = ['line1','line2','line3','line4'];
		if (!in_array($line, $lineArr)) {
			throw new Exception("line param not set", 1);
		}
        $lineSum = 0;
	    if ($this->examType==1) {
            $classInfo = TeachClass::find()->where(['school'=>$this->school,'grade'=>$this->grade,'type'=>$this->classType])->all();
            if($classInfo){
                foreach ($classInfo as $keyinfo => $valueinfo) {
                    $lineSum += $valueinfo->taskline->$line;
                }    
            }
        }elseif($this->examType==2){
               $class   = $this->classType=='lk'?1000:1001;
               $lineAll = Taskline::findOne(['grade'=>$this->grade,'banji'=>$class]);
               $lineSum = $lineAll->$line;
        }else{
            throw new Exception("Exam type in DataCollection Taskline has not set!", 1);
            
        }    
       return $lineSum;//=======================================
	}
    
    /**
     * @param  达标线类型
     * @return 各科达标线数组
     */
	public function getLineScore($line='line1')
	{
		$lineSum = $this->getLineSum($line);

		$data = $this->examType==1?$this->SchoolData->data:$this->SchoolData->examData;

		// $data=[
		// 	['id'=>1,'name'=>'aa','yw'=>'110','ds'=>'109','yy'=>'80','wl'=>'81','hx'=>'60','sw'=>'40','zf'=>'540'],
		// 	['id'=>2,'name'=>'bb','yw'=>'120','ds'=>'19','yy'=>'40','wl'=>'91','hx'=>'20','sw'=>'70','zf'=>'450'],
		// 	['id'=>3,'name'=>'cc','yw'=>'140','ds'=>'119','yy'=>'140','wl'=>'51','hx'=>'50','sw'=>'50','zf'=>'580'],
		// ];

		ArrayHelper::multisort($data,'zf',SORT_DESC,SORT_NUMERIC);
		if (isset($data[$lineSum-1]['zf'])) {
			$zfline = $data[$lineSum-1]['zf'];
		}else{
			throw new Exception("getLineSum IN Beyonline class ZFline can not get!", 1);
		}
		//$subjectLine = array();
		foreach ($this->subjects as $key => $subject) {
			ArrayHelper::multisort($data,$subject,SORT_DESC,SORT_NUMERIC);
			$subjectLine = $data[$lineSum-1][$subject];
			$subjectLineArr[$subject] = $subjectLine;
		}

		$classList = $this->SchoolData->getClassList();

		foreach ($classList as $class => $classAnalysis) {
			$classdata = $classAnalysis->data;
			$beyonline = array();
			foreach ($this->subjects as $key => $subject) {
				$subjectLine = $subjectLineArr[$subject];
				$beyonline[$subject]['beyonline'] = count(array_filter($classdata,function($var)use($subject,$subjectLine){
					return $var[$subject]>=$subjectLine;
				}));
			    $beyonline[$subject]['realbeyonline'] = count(array_filter($classdata,function($var)use($subject,$subjectLine,$zfline){
					if($var[$subject]>=$subjectLine&&$var['zf']>=$zfline)
					{
		                  return true;
					}
				}));
			}
			$classAnalysis->setBeyonline($beyonline);
			$classList[$class] = $classAnalysis;
		}
		var_export($subjectLine);
		exit();




	}


}


