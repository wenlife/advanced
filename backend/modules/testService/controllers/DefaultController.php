<?php
namespace backend\modules\testService\controllers;
use Yii;
use yii\web\Controller;
use PHPExcel;
use backend\libary\CommonFunction;
/**
 * Default controller for the `testService` module
 */
class DefaultController extends Controller
{
    /**
     * 返回本次考试各个学校的统计情况
     * @return string
     */
    public function actionIndex($id=null)
    {
          
        return $this->render('index');
    }
    /**
    * 设置本次考试和系统里的班级对应关系
    */
}
