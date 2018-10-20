<?php
/*
* 表格模型需要实现的类
*/
namespace backend\modules\test\libary;

interface Exchange
{
	/*
	* 使用模型数据填充一个表格
	*/
	public function fillForm($model);

	//返回该表格对应的视图名称
	public function getViewName();

	//处理POST数据中用来填充表格的数据，经过转换然后返回
	public function postModel($post);
}

?>