<?php
namespace backend\modules\testService\libary;
use Yii;
use backend\modules\testService\libary\DataCollection;
use backend\modules\testService\models\ScWenke;
/**
* 该类继承自DataCollection ,负责处理文科数据
*/
class DataColw extends DataCollection
{	

	public function __construct(){
		$this->type ='wk';
		$this->subjects = $this->wkSubject;
		$this->dataModel = new ScWenke();
	}
}



?>