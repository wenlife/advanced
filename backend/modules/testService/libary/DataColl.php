<?php
namespace backend\modules\testService\libary;
use Yii;
use backend\modules\testService\libary\DataCollection;
use backend\modules\testService\models\ScLike;
/**
* 该类继承自DataCollection ,负责处理理科数据
*/
class DataColl extends DataCollection
{	

	public function __construct(){
		$this->type ='lk';
		$this->subjects = $this->lkSubject;
		$this->dataModel = new ScLike();
	}
}



?>