<?php
namespace backend\modules\testService\libary;
use Yii;
use backend\modules\school\models\TeachClass;
use backend\modules\testService\models\Taskline;
use backend\modules\testService\models\Exam;

public class Linedata{

	public $line1;
	public $line2;
	public $line3;
	public $line4;
	public $exam;
	public $grade;
	public $type;
	public $school;
   
    public function __construct($exam,$school=null)
    {
    	$this->exam = $exam;

    	$this->school = $school;
    }

    public function getline($exam,$school){

    }


}