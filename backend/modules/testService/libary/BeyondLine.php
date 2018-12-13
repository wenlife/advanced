<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrayHelper;
use yii\base\Exception;
use backend\modules\testService\models\Exam;
use backend\modules\school\models\TeachClass;
use backend\modules\testService\models\Taskline;
use backend\modules\testService\models\Classmap;
/**
 * 该类主要负责处理达标率的计算
 * 计算有两种情况，4条达标线
 */
class BeyondLine
{
	public $exam;
	public $examType;
	public $grade;
	public $school;
	public $except;
	public $classType;
	public $subjects;
	public $SchoolData;

	public $allLine = ['line1','line2','line3','line4'];

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
     * [对当前的SchollAnalysis对象的班级列表进行达标人数的初始化，四条线，都有达标和有效达标]
     * @return [type] [description]
     */
	public function initLineCount()
	{
		$classList = $this->SchoolData->getClassList();

		foreach ($this->allLine as $key => $line) {
			$lineArr[$line] = $this->getLineScore($line);
		}

		$this->SchoolData->setLineScore($lineArr);//将达标分写入学校分析对象

		foreach ($classList as $class => $classAnalysis) {
			$classdata = $classAnalysis->data;
			$beyonline = array();

			foreach ($lineArr as $line => $subjectLineArr) {
                
    			if (isset($subjectLineArr['zf'])) {
					$zfline =$subjectLineArr['zf'];
				}else{
					throw new Exception("getLineSum IN Beyonline class ZFline can not get!", 1);
				}			

				foreach ($this->subjects as $key => $subject) {
					$subjectLine = $subjectLineArr[$subject];
              
	        		$beyonline[$subject][$line]['beyondline'] = count(array_filter($classdata,function($var)use($subject,$subjectLine){
						return $var[$subject]>=$subjectLine;
					}));
				    $beyonline[$subject][$line]['realbeyondline'] = count(array_filter($classdata,function($var)use($subject,$subjectLine,$zfline){
						if($var[$subject]>=$subjectLine&&$var['zf']>=$zfline)
						{
			                  return true;
						}
					}));
				}
				//$subjectLine = $subjectLineArr[$subject];
			}
			$classAnalysis->setBeyonline($beyonline);
			$classList[$class] = $classAnalysis;
		}
		return $this->SchoolData->setClassList($classList);
	}

	/**
	 * [功能x2： 1.写入达标分，2.在每个班级中写入当前达标线每科的达标和有效达标]
	 * @param  [string] $line [达标线]
	 * @return [SchoolAnalysis] [初始化的学校分析对象]
	 */
	public function getLineCount($line)
	{
		if(!in_array($line, $this->allLine)){throw new Exception("the line name was not in system setting!", 1);}

		$classList = $this->SchoolData->getClassList();
		$lineScore = $this->getLineScore($line);

		$this->SchoolData->setLineScore($lineScore);//将达标分写入学校分析对象
        
		foreach ($classList as $class => $classAnalysis) {
			$classdata = $classAnalysis->data;
            //班级的当前达标线设置目标
			$target = Classmap::find()->where(['school'=>$this->school,'grade'=>$this->grade,'excel_class_name'=>$class])
                         ->one()->sysClass->taskline->$line;
			$beyonline = array();
			if (isset($lineScore['zf'])) {
				$zfline =$lineScore['zf'];
			}else{
				throw new Exception("getLineSum IN Beyonline class ZFline can not get!", 1);
			}

			foreach ($this->subjects as $key => $subject) {
				$subjectLine = $lineScore[$subject];
          
        		$beyonline[$subject]['beyondline'] = count(array_filter($classdata,function($var)use($subject,$subjectLine){
					return $var[$subject]>=$subjectLine;
				}));
			    $beyonline[$subject]['realbeyondline'] = count(array_filter($classdata,
			    	function($var)use($subject,$subjectLine,$zfline){
					 if($var[$subject]>=$subjectLine&&$var['zf']>=$zfline){return true;
					}
				}));
			}
				//$subjectLine = $lineScore[$subject];
            $classAnalysis->setTarget($target);
			$classAnalysis->setBeyonline($beyonline);
			$classList[$class] = $classAnalysis;
		}
		return $this->SchoolData->setClassList($classList);

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
               $lineSum = $lineAll?$lineAll->$line:0;
 

        }else{
            throw new Exception("Exam type in DataCollection Taskline has not set!", 1);
            
        }    
       return $lineSum;//=======================================
	}


    /**
     * [获取当前达标线的分数，返回以科目为键的数组]
     * @param  [type] [description]
     * @return [type] [description]
     */
	public function getLineScore($line)
	{
		$lineSum = $this->getLineSum($line);
		//$subjectLineArr = ['yw'=>100,'ds'=>'110','yy'=>90,'wl'=>50,'hx'=>80,'sw'=>60,'zf'=>480];
		foreach ($this->subjects as $key => $subject) {
			//ArrayHelper::multisort($data,$subject,SORT_DESC,SORT_NUMERIC); multiSort效率太低，并且需要引入其他值
			//=====================改用数据库获取相应内容==================
			$whereCondition = $this->examType==1?['test_id'=>$this->exam,'stu_school'=>$this->school]:['test_id'=>$this->exam];
			$query = $this->SchoolData->model->find()->where($whereCondition);

			if ($this->except) {
				//======================注意此处的排除硬编码J==========================
                 $query = $query->andWhere(['not like','note','J']);
                //===================================================================
             }
			$orderedData = $query->orderBy($subject.' desc')
					   ->offset($lineSum-1)
					   ->one();
			//==============================================================
			//$subjectLine = $data[$lineSum-1][$subject];
			$subjectLineArr[$subject] = $orderedData->$subject;
		}

	    return $subjectLineArr;

	}

	public function getInitedSchoolAnalysis()
	{
		return $this->SchoolData;
	}
}


