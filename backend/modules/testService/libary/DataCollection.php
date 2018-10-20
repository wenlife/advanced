<?php
namespace backend\modules\testService\libary;
use Yii;
use backend\modules\testService\models\Exam;
use backend\modules\testService\models\ScLike;
use backend\modules\testService\models\ScWenke;
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
    public $line_grade=1000; //达标总数 总分
    public $line_subject=500;//达标总数 科目

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
    /**
    * 载入所需要的数据，根据文理科自动获取所需要的成绩数据
    * @param 考试ID（必须） 学校 班级 排序方式
    * @return 将获得内容赋值给类成员Data并返回
    */
    public function loadData($test,$school=null,$class=null,$sort=null,$limit=null)
    {        
        $whereArray['test_id'] = $test;
        if ($school!=null) {
           $whereArray['stu_school'] = $school;
        }
        if ($class!=null) {
           $whereArray['stu_class'] = $class;
        }
        if ($limit=='grade') {
           $limit = $this->line_grade;
        }elseif ($limit=='subject') {
            $limit = $this->line_subject;
        }
        $this->whereArray = $whereArray;
        $re = $this->dataModel->find()->where($whereArray)->orderBy($sort)->limit($limit)->all();
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
    public function getDistinct($col,$orderBy=null,$limit=null)
    {
        $re = array();
        if ($limit=='grade') {
           $limit = $this->line_grade;
        }elseif($limit=='subject') {
            $limit = $this->line_subject;
        }
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
    public function getUponLine($exam,$school,$zflist)
    { 
        $re = array();
        $pass_line = array();
        foreach ($this->subjects as $keys => $subject) {
             $stu = $this->loadData($exam,$school,null,$subject.' desc','subject');
             $passline[$subject] = $this->getColomnMin($subject);
              foreach ($stu as $keyStu => $valueStu) {
                 // $classList[$valueStu->stu_class] = $valueStu->stu_class;
                  $re[$valueStu->stu_class][$subject][] = $valueStu->stu_id;
              }
          }
        $re_count = array();
        //$['二班']['yw'] = ['111','222'];
        foreach ($re as $class => $classArray) {
            foreach ($classArray as $subject => $subjectArray) {

                $under = $re_count[$class][$subject]['uponline'] = count($subjectArray);

                $upper = $re_count[$class][$subject]['realuponline'] = count(array_intersect($subjectArray,$zflist));
                if ($re_count[$class][$subject]['uponline']>0) {
                     $re_count[$class][$subject]['percent'] = $upper/$under;
                }else{
                     $re_count[$class][$subject]['percent'] = 0;
                }
            }
        }

        $re_count['line'] = $passline;
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