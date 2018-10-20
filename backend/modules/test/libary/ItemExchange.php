<?php
/*
* 表格与模型数据交换类
* 如果模型是有数据的，则使用模型的TYPE决定题目类型，如果没有则需指定类型
* 能够根据模型创建表格，返回表格，或者填充后返回表格
*/
namespace backend\modules\test\libary;

use backend\modules\test\forms\SingleChoiceForm;
use backend\modules\test\forms\MultiChoiceForm;
use backend\modules\test\forms\JuggForm;
use backend\modules\test\forms\MmoForm;

class ItemExchange{

	public $model;
	public $form;

	public function __construct($model,$type=null)
	{	
		if ($type==null) {
			if (!is_null($model->type)) {
				$type = $model->type;
			}else{
				exit('Item Type Not Set !');
			}
		}
		$this->model = $model;
		$this->createForm($type);

	}

	public function setModel($model)
	{
		$this->model = $model;
	}
	public function setForm($form)
	{
		$this->form = $form;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function getForm()
	{
		return $this->form;
	}
	/*
	* 创建不同题类型对应的表格类，
	*/
	public function createForm($type)
	{

		switch ($type) {
			case '1':
				$this->form = new SingleChoiceForm();
				break;
			case '2':
				$this->form = new MultiChoiceForm();
				break;
			case '3':
				$this->form = new JuggForm();
				break;
			case '4':
				$this->form = new MmoForm();
				break;	
			default:
				exit('Undefined item type!');
				break;
		}
	}

	public static function typeNames()
	{
		return [
		'1'=>'单选题',
		'2'=>'多选题',
		'3'=>'判断题',
		'4'=>'综合题',
		];
	}

	public function fillForm()
	{
		$this->form->fillForm($this->model);
	}
	
}
?>