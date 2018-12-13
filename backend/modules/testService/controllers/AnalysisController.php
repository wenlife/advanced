<?php
namespace backend\modules\testService\controllers;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use backend\modules\testService\forms\UploadXml;

use backend\modules\testService\models\Exam;
use backend\modules\testService\models\ScLike;
use backend\modules\testService\models\SclikeSearch;
use backend\modules\testService\models\ScWenke;
use backend\modules\testService\models\ScwenkeSearch;

// use backend\modules\testService\libary\DataAnalysis;
// use backend\modules\testService\libary\DataCollection;
// use backend\modules\testService\libary\DataColl;
// use backend\modules\testService\libary\DataColw;
// use backend\modules\testService\libary\ClassRespond;
// use backend\modules\school\models\TeachClass;
use PHPExcel;
use backend\libary\CommonFunction;
use backend\modules\testService\models\Classmap;
use yii\filters\VerbFilter;

use backend\modules\testService\libary\ExamAnalysis;
use backend\modules\testService\libary\SchoolAnalysis;
use backend\modules\testService\libary\ClassAnalysis;
use backend\modules\testService\libary\CompareAnalysis;
use backend\modules\testService\libary\Beyondline;

class AnalysisController extends Controller
{


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'clean' => ['POST'],
                ],
            ],
        ];
    }
   public function init()
   {
     if (Yii::$app->user->isGuest) 
      {
        $this->layout = '/simple';
      }
   }
    /**
     * 返回本次考试各个学校的统计情况
     * @return string
     */
    public function actionIndex($id=null)
    {

        $lkExamAnalysis = new ExamAnalysis($id,'lk'); 
        $wkExamAnalysis = new ExamAnalysis($id,'wk');  
        return $this->render('index',[
            'lkExam'=>$lkExamAnalysis,
            'wkExam'=>$wkExamAnalysis
            ]);
    }


    public function actionTest($school="市七中",$exam=6,$bj=null,$export=0)
    {
        $data = new ExamAnalysis($exam,'wk');

        $comapreData = new ExamAnalysis($data->getCompareExam(),'wk');
        
        $schoolAnalysis = $data->getSchoolAnalysis($school);

        $compare = new CompareAnalysis($schoolAnalysis,$comapreData->getSchoolAnalysis($school));

        $compare->generateOrder();
        $compare->generateImprove();
        $schoolAnalysis = $compare->getAnalysis();

        $beyondline = new Beyondline($schoolAnalysis);
        $beyondline->initLineCount();

        $schoolAnalysis = $beyondline->getInitedSchoolAnalysis();

        return $this->render('test',['data'=>$data,'schooldata'=>$schoolAnalysis]);

    }
    
    /**
     * 该类负责导出本次成绩分析数据      
     * @return []
     */
    public function export($school,$exam,$type)
    {
        $data = new ExamAnalysis($exam,$type);

        $comapreData = new ExamAnalysis($data->getCompareExam(),$type);
        
        $schoolAnalysis = $data->getSchoolAnalysis($school);

        $compare = new CompareAnalysis($schoolAnalysis,$comapreData->getSchoolAnalysis($school));

        $compare->generateOrder();
        $compare->generateImprove();
        $schoolAnalysis = $compare->getAnalysis();

        $beyondline = new Beyondline($schoolAnalysis);
        $beyondline->initLineCount();

        $schoolAnalysis = $beyondline->getInitedSchoolAnalysis();
        //数据初始化完成；

        $exportArray = array();

        $header = ['班级'];
        $subjects = $data->getSubjects();
        foreach ($subjects as $key => $subject) {
            array_push($header,$subject);
         } 
        $exportArray[] = $header;
        $lineScore = $school->getLineScore();
        $gradeAvg = $school->getAvg();
        foreach ($subjects as $key => $subject) {
            array_push($header,$subject);
        } 



    }

    /**
    *该页面为学校成绩分析综合页面
    *
    **/
    public function actionDash($school,$exam)
    {

        $lkExam = new ExamAnalysis($exam,'lk');
        $wkExam = new ExamAnalysis($exam,'wk');

        $lkSchool = $lkExam->getSchoolAnalysis($school);
        $wkSchool = $wkExam->getSchoolAnalysis($school);

        $lksearchModel = new SclikeSearch();
        $lkdataProvider = $lksearchModel->search(Yii::$app->request->queryParams,$school,$exam);
        $wksearchModel = new ScwenkeSearch();
        $wkdataProvider = $wksearchModel->search(Yii::$app->request->queryParams,$school,$exam);

        return $this->render('dash', [
            'lkSchool'=>$lkSchool,
            'wkSchool'=>$wkSchool,
            'lksearchModel'  => $lksearchModel,
            'lkdataProvider' => $lkdataProvider,
            'wksearchModel'  => $wksearchModel,
            'wkdataProvider' => $wkdataProvider,

        ]);
    }

    public function actionAvg($school,$exam)
    {
         
        $lkExam = new ExamAnalysis($exam,'lk');
        $wkExam = new ExamAnalysis($exam,'wk');

        $lkSchool = $lkExam->getSchoolAnalysis($school);
        $wkSchool = $wkExam->getSchoolAnalysis($school);


        return $this->render('avg',[
            'lkSchool'=>$lkSchool,
            'wkSchool'=>$wkSchool,
        ]);
    }


    public function actionImprove($school,$exam)
    {
        $lkExam = new ExamAnalysis($exam,'lk');
        $lkSchool = $lkExam->getSchoolAnalysis($school);
        $lkcomapreData = new ExamAnalysis($lkExam->getCompareExam(),'lk');
        $lkCompare = new CompareAnalysis($lkSchool,$lkcomapreData->getSchoolAnalysis($school));
        $lkCompare->generateImprove();
        $lkSchool = $lkCompare->getAnalysis();

        $wkExam = new ExamAnalysis($exam,'wk');
        $wkSchool = $wkExam->getSchoolAnalysis($school);
        $wkcomapreData = new ExamAnalysis($wkExam->getCompareExam(),'wk');
        $wkcomapre = new CompareAnalysis($wkSchool,$wkcomapreData->getSchoolAnalysis($school));
        $wkcomapre->generateImprove();
        $wkSchool = $wkcomapre->getAnalysis();


        return $this->render('improve',[
            'lkSchool'=>$lkSchool,
            'wkSchool'=>$wkSchool,   
        ]);
    }


    public function actionBeyondline($school,$exam)
    {
        $line = 'line1';
        if (Yii::$app->request->isPost) {
            $line = Yii::$app->request->post()['linetype'];
        }
        $lkExam = new ExamAnalysis($exam,'lk');
        $lkSchool = $lkExam->getSchoolAnalysis($school);
        $lkBeyondline = new Beyondline($lkSchool);
        $lkBeyondline->getLineCount($line);
        $lkSchool = $lkBeyondline->getInitedSchoolAnalysis();



        $wkExam = new ExamAnalysis($exam,'wk');
        $wkSchool = $wkExam->getSchoolAnalysis($school);
        $wkBeyondline = new Beyondline($wkSchool);
        $wkBeyondline->getLineCount($line);
        $wkSchool = $wkBeyondline->getInitedSchoolAnalysis();

        
        return $this->render('beyondline',[
            'linetype'=>$line,
            'lkSchool'=>$lkSchool,
            'wkSchool'=>$wkSchool,
        ]);
      
    }


    //班级成绩的分析
    public function actionBj($school,$exam,$bj=null,$export=0)
    {
        $lkExam = new ExamAnalysis($exam,'lk');
        $lkClassList = array_keys($lkExam->getSchoolAnalysis($school)->getClassList());

        $wkExam = new ExamAnalysis($exam,'wk');
        $wkClassList = array_keys($wkExam->getSchoolAnalysis($school)->getClassList());

        $classlist = array_merge($lkClassList,$wkClassList);

        if (!$bj) {
           $bj = 0;
        }

        $examAnalysis = array_key_exists($bj,$lkClassList)?$lkExam:$wkExam;
        $type = array_key_exists($bj,$lkClassList)?'lk':'wk';
        $comapreData = new ExamAnalysis($examAnalysis->getCompareExam(),$type);
        $schoolAnalysis = $examAnalysis->getSchoolAnalysis($school);

        $Compare = new CompareAnalysis($schoolAnalysis,$comapreData->getSchoolAnalysis($school));
        $Compare->generateOrder();
        $schoolAnalysis = $Compare->getAnalysis();
        $class =  $schoolAnalysis->getClassAnalysis($classlist[$bj]);

        //$this->export('班级成绩',null,$scbj);
        return $this->render('bj',[
            'bj'=>$bj,
            'bjarr'=>$classlist,
            'Analysis'=>$class
        ]);
    }


    /**
    * 设置本次考试和系统里的班级对应关系
    */
    public function actionRespond($id)
    {
        $mySchool = "市七中";
        if($exam = Exam::findOne($id))
        {
             $grade = $exam->stu_grade;
        }
        $datalk = new DataColl();
        $datalk->loadData($id,$mySchool);
        $datawk = new DataColw();
        $datawk->loadData($id,$mySchool);
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();

        $bj = array_merge($bjlk,$bjwk);
        sort($bj);//班级排序

        $classes = TeachClass::find()->where(['school'=>$mySchool,'grade'=>$grade])->all();
        //设置班级对应关系
        if(Yii::$app->request->post())
        {
            $post = Yii::$app->request->post();
            $re = array();
            foreach ($post as $bj_key => $class_id) {
             //   echo $class_id;
                if (is_numeric($class_id)) {
                     $re[$class_id] = $bj[$bj_key];
                }
            }

            //对学校进行设置；
            $store[$post['school']] = $re;
            ClassRespond::writeRespond($post['school'],$grade,$re);

            // file_put_contents('respond',serialize($store));
            // $reload = unserialize(file_get_contents('respond'));
            // $reload = $reload[$post['school']];
            $reload = $re;

            $view_res = array();
            foreach ($reload as $key2 => $value2) {
                $banji = TeachClass::find()->where(['id'=>$key2])->one();
                $view_res[$key2] = $banji->title;
            }
            return $this->render('respond_display',['school'=>$post['school'],'reload'=>$reload,'view_res'=>$view_res,'exam'=>$id]);           
        }
        return $this->render('respond',['bj'=>$bj,'classes'=>$classes]);
    }

    public function actionImport($id=null)
    {
       $model = new UploadXml();
       if ($id!=null) {
          $model->exam = $id;
       }
       $exams = Exam::find()->all();


      if($post=Yii::$app->request->post())
        {
            $model->load($post);
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($url = $model->upload()) {
               if($model->file->extension == 'xlsx'){
                    $objReader = new \PHPExcel_Reader_Excel2007();
                    $objPHPExcel = $objReader->load($url,'utf-8');
                }elseif($model->file->extension == 'xls'){
                    $objReader = new \PHPExcel_Reader_Excel5();
                    $objPHPExcel = $objReader->load($url,'utf-8');
                }
            }else{
                exit('upload error');
            }
            
            $objWorksheet = $objPHPExcel->getSheet(0);
            $highestRow = $objWorksheet->getHighestRow();//最大行数，为数字
            $highestColumn = $objWorksheet->getHighestColumn();//最大列数 为字母
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); //将字母变为数字
            $tableData = [];
            for($row = 2;$row<=$highestRow;$row++){
                for($col=0;$col< $highestColumnIndex;$col++){
                    $tableData[$row][$col] = $objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
                }
            }

            //exit(var_export($model));
            $scModel = null;
            if ($model->type=='1') {
               $scModel = new ScLike();
            }elseif($model->type=='2'){
                $scModel = new ScWenke();
            }else{
                exit('not defined!');
            }
            //return $this->render('display',['exams'=>$exams,'model'=>$model,'data'=>$tableData]);
            // 验证

            // 导入
            //$score = new AnaScore();

            $conn = Yii::$app->db->beginTransaction();
            $i=1;
            foreach ($tableData as $key => $data) {
                $nscore = clone $scModel;
                $nscore->test_id = $model->exam;
                $nscore->stu_id = $data[0];
                $nscore->stu_name = $data[1];
                $nscore->stu_class = $data[2];
                $nscore->stu_school = $data[3];
                $nscore->yw = $data[4];
                $nscore->ds = $data[5];
                $nscore->yy = $data[6];
                if ($model->type == '1') {
                    $nscore->wl = $data[7];
                    $nscore->hx = $data[8];
                    $nscore->sw = $data[9];
                }
                if ($model->type=='2') {
                    $nscore->zz = $data[7];
                    $nscore->ls = $data[8];
                    $nscore->dl = $data[9];
                }
                $nscore->zf = $data[10];
                $nscore->mc = $data[11];
                $nscore->note = $data[12];
                //exit(var_export($nscore->stu_id));
                if(!$nscore->save())
                { 
                    //(var_export($nscore->stu_id));
                    $conn->rollBack();
                    exit(var_export($nscore->getErrors()).'第'.$i.'个，姓名：'.$nscore->stu_name);

                }

                $i++;

            }
            $conn->commit();

            $model->delFile();
            //exit(var_export($tableData));
            
            $this->redirect(['index','id'=>$id]);
        }


        return $this->render('import',['exams'=>$exams,'model'=>$model,'id'=>$id]);
    }


    public function actionClean($id)
    {
        if (is_numeric($id)) {
            ScWenke::deleteAll(['test_id'=>$id]);
            ScLike::deleteAll(['test_id'=>$id]);
           return $this->redirect(['index','id'=>$id]);
        }
    }


 

    public function actionExport()
    {

        $headerArr = ['编号','用户名','生成时间'];

        $fileName = "abc.xls";
        $objPHPExcel = new PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        $key = ord('A');
        foreach($headerArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum.'1',$v);
            $key += 1;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $writer = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $writer->save('php://output');
        return 0;
    }
}
