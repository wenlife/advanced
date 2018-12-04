<?php
namespace backend\modules\testService\libary;

use yii\helpers\ArrayHelper;

class SubjectEntity
{
	public $priefname;
	public $cname;
	public $teacher;
	public $avg;
	public $max;
	public $improve;
	public $pass;

	function __construct($priefname)
	{
		$this->priefname = $priefname;
		$cnameArray =  ['yw'=>'语文','ds'=>'数学','yy'=>'英语',
		                'wl'=>'物理','hx'=>'化学','sw'=>'生物',
		                'zz'=>'政治','ls'=>'历史','dl'=>'地理',
		                'xx'=>'信息技术','ty'=>'体育','zf'=>'总分'];
		$this->cname = ArrayHelper::getValue($cnameArray,$priefname);
	}
}