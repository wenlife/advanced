<?php
namespace backend\modules\testService\libary;
use Yii;
use backend\modules\testService\models\Exam;
use backend\modules\testService\models\ScLike;
use backend\modules\testService\models\ScWenke;
use backend\modules\school\models\TeachClass;
use yii\helpers\ArrayHelpr;
/**
* 该类完成的功能
*@input 
*获得一个成绩数据的类组成的数组
*
*@output
*满足成绩分析每个控制器所需求的各种数据
*注：该类只能分析当前获取的data数据，不能与其他数据进行对比
*
**/
class DataCollection{

	public $data; //读取的数据数组
    public $dataModel;//数据模型表
	public $type;// lk or wk
	public $subjects; //科目
    public $whereArray;//读取本次数据的where数组
	public $lkSubject = ['yw','ds','yy','wl','hx','sw','zf'];//理科科目数组
	public $wkSubject = ['yw','ds','yy','zz','ls','dl','zf'];//文科科目数组
    public $rank;//进行排序用的数组
    public $line_grade; //达标总数 重本
    public $line_subject;//达标总数 本科
    public $school='市七中';
    public $test;//本次分析的考试ID
    public $lineType;//计算的达标类型

	public function __construct($type)
	{
		$this->type = $type;
		if($type=='lk'){
			$this->subjects = $this->lkSubject;
            $this->dataModel = new ScLike();
		}elseif($type=='wk'){
			$this->subjects = $this->wkSubject;
            $this->dataModel = new ScWenke();
		}

	}
    public function getType()
    {
        return $this->type;
    }

    public function getSubjects()
    {
        return $this->subjects;
    }
    public function getData(){
        return $this->data;
    }
    //返回达标总人数
    public function getLineSum(){
        return ['grade'=>$this->line_grade,'subject'=>$this->line_subject];
    }


    //获取不同类型的达标总人数
    public function getline($lineType)
    {
        $this->lineType = $lineType;
        if ($this->test) {
           $exam = Exam::findOne($this->test);
           $grade = $exam->stu_grade;
        }
        $classInfo = TeachClass::find()->where(['school'=>$this->school,'grade'=>$grade,'type'=>$this->type])->all();
        $line_grade = 0;
        $line_subject = 0;

        if($classInfo){
            foreach ($classInfo as $keyinfo => $valueinfo) {
              // var_export($valueinfo->taskline);
              //  exit();
                $line_grade += $valueinfo->taskline->line1;
            }
            $this->line_grade = $line_grade;
            foreach ($classInfo as $keyinfo => $valueinfo) {
                $line_subject += $valueinfo->taskline->line3;
            }
            $this->line_subject = $line_subject;
        }

        switch ($lineType) {
            case 'grade':
                return $this->line_grade;
                break;
            case 'subject':
                return $this->line_subject;
                break;          
            default:
                exit(" $this->type is not a line type!");
                break;
        }
    }


    /**
    * 载入所需要的数据，根据文理科自动获取所需要的成绩数据
    * @param 考试ID（必须） 学校 班级 排序方式
    * @return 将获得内容赋值给类成员Data并返回
    */
    public function loadData($test,$school=null,$class=null,$sort=null,$lineType=null,$except=null)
    {

        $this->test = $test;
        $this->school = $school;        
        $whereArray['test_id'] = $test;
        if ($school!=null) {
           $whereArray['stu_school'] = $school;
        }
        if ($class!=null) {
           $whereArray['stu_class'] = $class;
        }


        $limit = $lineType?$this->getline($lineType):$lineType;
        
        $this->whereArray = $whereArray;
        if ($except) {
            $re = $this->dataModel->find()
                            ->where($whereArray)
                            ->andWhere(['not like','note',$except])
                            ->orderBy($sort)
                            ->limit($limit)
                            ->all();
          // var_export($re);
        //   exit();
        }else{
            $re = $this->dataModel->find()->where($whereArray)->orderBy($sort)->limit($limit)->all();
        }
        $this->data = $re;
        return $re;
    }

    //获取单科最高分学生
    public function getSubjectMax()
    {
        foreach ($this->subjects as $key => $subject) {
            $subjectMax[$subject] = $this->dataModel->find()->where($this->whereArray)->orderBy($subject.' desc')->one();
        }
        return $subjectMax;
    }

    /**
    * 返回选择数据里某列的各个不同值
    * @param  列名，数据库相关
    * @return 返回数组,仅数组，不含AR内容
    */
    public function getDistinct($col,$orderBy=null,$lineType=null)
    {
        $re = array();
        $limit = $lineType?$this->getline($lineType):$lineType;      
        $dis = $this->dataModel->find()->where($this->whereArray)->orderBy($orderBy)->select($col)->limit($limit)->distinct()->all();
        foreach ($dis as $key => $di) {
            $re[$key] = $di->$col;
        }
        return $re;
    }

    public function getSchoolList()
    {
        return $this->getDistinct('stu_school','stu_school');
    }   

    public function getClassList()
    {
       return  $this->getDistinct('stu_class','stu_class');
    }
    //返回某列最大值
	public function getColumnMax($col)
	{
		$max = 0;
        foreach ($this->data as $key => $value) {
         	if(isset($value->$col)&&$value->$col>$max){
         		$max = $value->$col;
         	}
        }
        return $max;
	}
    /*
    * 返回某列平均值
    * 需要从中去掉为0分的值
    * 
    */
	public function getColumnAvg($col)
	{
        $sum   = 0;
        $count = 0;
        foreach ($this->data as $key => $value) {
        	if(isset($value->$col)&&$value->$col>0){
         		$sum += $value->$col;
         		$count++;
         	}
        }
        if ($count == 0) {
        	return 0;
        }else{
        	return round($sum/$count,2);
        }
        
	}
    //返回某列及格率 ，注意150和100分的区别
    public function getColumnPass($col)
    {
        $sum = 0;
        $count = 0 ;
        $special = ['yw','ds','yy'];
        if (in_array($col,$special)) {
          $passline = 90;
        }else{
          $passline = 60;
        }
        
        foreach ($this->data as $key => $value) {
            if ($value->$col<=0) {
               continue;
            }
            if (isset($value->$col)) {
                $sum++;
                if ($value->$col>=$passline) {
                    $count++;
                }
            }
        }
        if ($sum==0) {
            return 0;
        }else{
            return round($count/$sum,3);
        }
    }
    /**
    * 返回所选数据里所有学生每科目的及格情况
    * @param 
    * @return 返回所有科目及格统计的数组
    */
    public function getPassed()
    {
        $passed = array();
        foreach ($this->subjects as $key => $subject) {
            $passed[$subject] = $this->getColumnPass($subject);
        }
        return $passed;
    }

    public function getMax()
    {
    	$max = array();
    	foreach ($this->subjects as $key => $subject) {
    	   $max[$subject] = $this->getColumnMax($subject);
    	}
    	return $max;
    }
    public function getColomnMin($subject)
    {

        $subject_min = null;
        foreach ($this->data as $keyd => $stu) {
            if (isset($stu->$subject)) {
                if ($subject_min==null) {
                    $subject_min = $stu->$subject;
                }elseif($subject_min>$stu->$subject){   
                    $subject_min = $stu->$subject;
                }
            }
        }
        return $subject_min;

    }
    /*
    * 取得各科的平均值，总分平均值为各科平均值的和
    */
    public function getAvg()
    {
    	$avg = array();
        $zf=0;
    	foreach ($this->subjects as $key => $subject) {
            if($subject=='zf'){
                continue;
            }
    		$avg[$subject] = $this->getColumnAvg($subject);
            $zf += $avg[$subject];
    	}
        $avg['zf'] = $zf;
 		return $avg;
    }
    /**
    *返回用于排名次的数组
    *@return 返回当前数据所有科目存在的分数值数组
    */
    public function getScoreList()
    {
        $scoreList = array();
        
        foreach ($this->subjects as $key_subject => $subject) {
           $tempList = array();
           foreach ($this->data as $key_score => $score) {
               $tempList[] = $score->$subject;
           }
           rsort($tempList);
           $scoreList[$subject] = $tempList;
        }
        return $scoreList;
    }
    /**
    * 返回所有内容每科的排名情况
    * @param 分数数组，用于进行名次比较
    * @return 返回以考号为依据的排名数组
    */
    public function getScoreRank($scorelist)
    {
        $compare = array();
        foreach ($this->subjects as $keysubject => $subject) {
            foreach ($this->data as $keydata => $stu) {
                $compare[$stu->stu_id][$subject] = array_search($stu->$subject, $scorelist[$subject])+1;
            }
        }
        $this->rank = $compare;
        return $compare;
    }

   /**
    * 该函数返回进步率
    *@param 上次考试对象
    *@return 进步率数组
    */
    public function avgFloat($gradeAvg,$avg_compare,$gradeAvg_compare)
    {
        $avg_self = $this->getAvg();
        $re = array();
        foreach ($this->subjects as $keys => $subject) {
            $float = ($avg_self[$subject]/$gradeAvg[$subject])-($avg_compare[$subject]/$gradeAvg_compare[$subject]);
            $re[$subject] = round($float,2);
        }
        return $re;
    }
    /**
    *  获取达标人数的数组，该函数会改变类的参数
    *@param 考试Id 学校
    *@return 每个班级，每个学科达标人数和达标线
    */

          
    public function getUponLine($exam,$school,$zflist,$except=null)
    { 
        $re = array();
        $re_count = array();
        $passline = array();

        foreach ($this->subjects as $keys => $subject) {
             $stu = $this->loadData($exam,$school,null,$subject.' desc',$this->lineType,$except);//需要按科目进行降序排序,依然按照之前的达标线进行计算

             //$re = $this->dataModel->find()->where($whereArray)->orderBy($sort)->limit($limit)->all();
             $passline[$subject] = $this->getColomnMin($subject);//获取该科目达标最低分
            //重新获取成绩数据，防止有最后一个分数相同的学生
            if ($except) {
             $stu = $this->dataModel->find()->where(['test_id'=>$exam,'stu_school'=>$school])
                                            ->andWhere(['>=',$subject,$passline[$subject]])
                                            ->andWhere(['not like','note',$except])
                                            ->orderBy($subject.' desc')
                                            //->limit($this->getline($this->lineType))
                                            ->all();                # code...
            }else{
             $stu = $this->dataModel->find()->where(['test_id'=>$exam,'stu_school'=>$school])
                            ->andWhere(['>=',$subject,$passline[$subject]])
                            ->orderBy($subject.' desc')
                            //->limit($this->getline($this->lineType))
                            ->all();
            }


              foreach ($stu as $keyStu => $valueStu) {
                 // $classList[$valueStu->stu_class] = $valueStu->stu_class;
                  $re[$valueStu->stu_class][$subject][] = $valueStu->stu_id;//达标的学生按科目、学科进行分类     
              }

          }

        //$['二班']['yw'] = ['111','222'];
        foreach ($re as $class => $classArray) {
            //foreach ($classArray as $subject => $subjectArray) {
            foreach ($this->subjects as $key2 => $subject) {
                $num = isset($classArray[$subject])?$classArray[$subject]:array();//没有达标则赋值为0；
                $under = $re_count[$class][$subject]['uponline'] = count($num);//统计每个班各科上线人数
                $upper = $re_count[$class][$subject]['realuponline'] = count(array_intersect($num,$zflist));//统计有效
                if ($re_count[$class][$subject]['uponline']>0) {
                     $re_count[$class][$subject]['percent'] = $upper/$under;//计算达标率
                }else{
                     $re_count[$class][$subject]['percent'] = 0;
                }
            }
        }

        $re_count['line'] = $passline;//每科的过线分数
        return $re_count;
    }
    
    /**
    * 两次考试之间的最高分比较
    *
    **/
    public function getMaxCompare(DataCollection $dataCollection)
    {
    	$compare = array();
    	$firstMax = $this->getMax();
    	$secondMax = $dataCollection->getMax();
    	if ($this->getType == $dataCollection->getType()) {
    		foreach ($subjects as $key => $subject) {
    			$compare[$subject]['first']  = $firstMax[$subject];
    			$compare[$subject]['second'] = $dataCollection[$subject];
    		}
    	}
    	return $compare;   	
    }

//class end
}
?>