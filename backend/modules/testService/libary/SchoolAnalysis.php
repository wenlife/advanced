<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrrayHelper;
// use backend\modules\testService\models\ScLike;
// use backend\modules\testService\models\ScWenke;

class SchoolAnalysis extends Analysis
{

	public $classList;
	public $school;

     function __construct($exam,$type,$school,$except=null)
     {
     	parent::__construct($exam,$type,$except);

     	$this->school = $school;

     	$query = $this->model->find()->where(['test_id'=>$exam,'stu_school'=>$school]);
     	if ($except) {

	    $query = $query->andWhere(['not like','note',$except]);

		}

		$this->data = $query->orderBy('zf desc')->asArray()->all();

		 $classList = $query->select(['stu_class'])->orderBy('stu_class')->distinct()->column();

		foreach ($classList as $key => $class) {
        	$classAnalysis[$class]= new ClassAnalysis($exam,$type,$school,$class,$except);
        }
        $this->classList = $classAnalysis;
        $this->init();

     }

     public function getClassList()
     {
        return $this->classList;
     }
}