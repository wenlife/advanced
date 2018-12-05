<?php
namespace backend\modules\testService\controllers;
use Yii;
use yii\web\Controller;
use backend\modules\testService\forms\UploadXml;
use backend\modules\testService\models\Exam;
use backend\modules\testService\models\ScLike;
use backend\modules\testService\models\SclikeSearch;
use backend\modules\testService\models\ScWenke;
use backend\modules\testService\models\ScwenkeSearch;
use yii\web\UploadedFile;
use backend\modules\testService\libary\DataAnalysis;
use backend\modules\testService\libary\DataCollection;
use backend\modules\testService\libary\DataColl;
use backend\modules\testService\libary\DataColw;
use backend\modules\testService\libary\ClassRespond;
use backend\modules\school\models\TeachClass;
use PHPExcel;
use backend\libary\CommonFunction;
use backend\modules\testService\models\Classmap;
use yii\filters\VerbFilter;

use backend\modules\testService\libary\ExamAnalysis;
use backend\modules\testService\libary\SchoolAnalysis;
use backend\modules\testService\libary\ClassAnalysis;
use backend\modules\testService\libary\CompareAnalysis;
use backend\modules\testService\libary\Beyondline;
/**
 * Default controller for the `testService` module
 */
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

        $exam = Exam::find()->where(['id'=>$id])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }

        $datalk = new DataColl();
        $datawk = new DataColw();
        $scLike  = $datalk->loadData($exam->id);
        $scWenke = $datawk->loadData($exam->id);
        $schools = $datalk->getSchoolList();//！！！学校从理科成绩中获得，所有要主要是否会出现问题
        if (!$schools) {
            $schools = $datawk->getSchoolList();
        }
        $schoolsAna = array();
        $schoolsAnaW = array();
        
        foreach ($schools as $key => $school) {
            $datalk->loadData($id,$school);
            $schoolsAna[$key]['max'] = $datalk->getMax();
            $schoolsAna[$key]['avg'] = $datalk->getAvg();

            $datawk->loadData($id,$school);
            $schoolsAnaW[$key]['max'] = $datawk->getMax();
            $schoolsAnaW[$key]['avg'] = $datawk->getAvg(); 
        }     
        return $this->render('index',[
            'exam'=>$exam,
            'lksubjects'=>$datalk->getSubjects(),
            'wksubjects'=>$datawk->getSubjects(),
            'scLike'=>$scLike,
            'scWenke'=>$scWenke,
            'schools'=>$schools,
            'schoolsAna'=>$schoolsAna,
            'schoolsAnaW'=>$schoolsAnaW,
            ]);
    }


    public function actionTest($school="市七中",$exam=6,$bj=null,$export=0)
    {
        $data = new ExamAnalysis($exam,'lk');

        $comapreData = new ExamAnalysis($data->getCompareExam(),'lk');
        
        $schoolAnalysis = $data->getSchoolAnalysis($school);

        $compare = new CompareAnalysis($schoolAnalysis,$comapreData->getSchoolAnalysis($school));

      //  $compare->generateOrder();
        $compare->generateImprove();
        $schoolAnalysis = $compare->getAnalysis();

        $beyondline = new Beyondline($schoolAnalysis);
        $beyondline->initLineCount();

        $schoolAnalysis = $beyondline->getInitedSchoolAnalysis();

        //var_export($schoolAnalysis);
        //exit();

        

       // $dataCompare = new ExamAnalysis($data->getCompareExam(),'lk');

        //$compareSchoolAnalysis = $dataCompare->getSchoolAnalysis('市七中');
        
      //  $compare = new CompareAnalysis($schoolAnalysis,$compareSchoolAnalysis);

       // $compare->generateImprove();
      //  $compare->generateOrder();
       // $schoolAnalysis = $compare->getAnalysis();

       // var_export($schoolAnalysis->getClassAnalysis('15班'));
       // exit();


        //var_export($data);
        // $schooList = $data->getSchoolList();

        // foreach ($schooList as $school => $schoolAnalysis) {
        //    $classList =  $schoolAnalysis->getClassList();
        //    foreach ($classList as $class => $classAnalysis) {
        //        echo $class;
        //        var_export($classAnalysis->getAvg());
        //    }
        // }

        // var_export($data->getMax());
        return $this->render('test',['data'=>$data,'schooldata'=>$schoolAnalysis]);

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


    /**
    *该页面为学校成绩分析综合页面
    *
    **/
    public function actionDash($school,$exam)
    {
        $test = Exam::find()->where(['id'=>$exam])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }

        //该次考试 所选学校的文理科成绩信息
        $datalk = new DataColl();
        $sclk = $datalk->loadData($exam,$school);
        $subjectmaxlk = $datalk->getSubjectMax();
        //var_export($datalk->getSubjectMax());
        //exit();
       // $avglkSchool = $datalk->getAvg();
        $datawk = new DataColw();
        $scwk = $datawk->loadData($exam,$school);
        $subjectmaxwk = $datawk->getSubjectMax();
        //$maxSubject = array_merge($max1,$max2);
        //$avgwkSchool = $datawk->getAvg();
         if (!$scwk||!$sclk) {
           return $this->render('error',['message'=>'您所选的考试成绩还未录入！']);
        }

        $lksearchModel = new SclikeSearch();
        $lkdataProvider = $lksearchModel->search(Yii::$app->request->queryParams,$school,$exam);
        $wksearchModel = new ScwenkeSearch();
        $wkdataProvider = $wksearchModel->search(Yii::$app->request->queryParams,$school,$exam);

        return $this->render('dash', [
            'exam'=>$test,
            'school'=>$school,
            'sclk'=>$sclk,
            'scwk'=>$scwk,
            'wksubjects'=>$datawk->getSubjects(),
            'lksubjects'=>$datalk->getSubjects(),
            'lksearchModel'  => $lksearchModel,
            'lkdataProvider' => $lkdataProvider,
            'wksearchModel'  => $wksearchModel,
            'wkdataProvider' => $wkdataProvider,
            'subjectmaxlk'=>$subjectmaxlk,
            'subjectmaxwk'=>$subjectmaxwk,
        ]);
    }

    public function actionAvg($school,$exam)
    {
        $test = Exam::find()->where(['id'=>$exam])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }
        //该次考试 所选学校的文理科成绩信息
        $datalk = new DataColl();
        $sclk = $datalk->loadData($exam,$school);
        $avglkSchool = $datalk->getAvg();
        $datawk = new DataColw();
        $scwk = $datawk->loadData($exam,$school);
        $avgwkSchool = $datawk->getAvg();

        //所选考试和学校的班级文理科班级列表
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();
                //文理科班级成绩以及班级分析数据
        // max 最高分  avg 平均分 pass及格率 float进步率
        $scAnal = array();
        foreach ($bjlk as $keyl => $bjl) {
            $datalk->loadData($exam,$school,$bjl);
           // $datalk_compare->loadData($test_compare->id,$school,$bjl);
            $scAnal[$keyl]['max'] = $datalk->getMax();
            $scAnal[$keyl]['avg'] = $datalk->getAvg();
            $scAnal[$keyl]['pass'] = $datalk->getPassed();
          //  $scAnal[$keyl]['float'] = $datalk->avgFloat($avglkSchool,$datalk_compare->getAvg(),$avglkSchool_compare);
        }
       // $avgFloatw = array();//进步率数组
        $scAnaw = array();
        foreach ($bjwk as $keyw => $bjw) {
            $datawk->loadData($exam,$school,$bjw);
        //    $datawk_compare->loadData($test_compare->id,$school,$bjw);
            $scAnaw[$keyw]['max'] = $datawk->getMax();
            $scAnaw[$keyw]['avg'] = $datawk->getAvg();
            $scAnaw[$keyw]['pass'] = $datawk->getPassed();
        //    $scAnaw[$keyw]['float'] = $datawk->avgFloat($avgwkSchool,$datawk_compare->getAvg(),$avgwkSchool_compare);
        }
                //任教对应关系读取；
        $resModel = new ClassRespond();
        $resTeacher = $resModel->getTeachers($school,$exam);


        return $this->render('avg',[
            'school'=>$school,
            'exam'=>$test,
            'bjlk'=>$bjlk,
            'bjwk'=>$bjwk,
            'wksubjects'=>$datawk->getSubjects(),
            'lksubjects'=>$datalk->getSubjects(),
            'avglkSchool'=>$avglkSchool,
            'avgwkSchool'=>$avgwkSchool,
            'resTeacher'=>$resTeacher,
            'scAnal'=>$scAnal,
            'scAnaw'=>$scAnaw,
        ]);
    }


    public function actionImprove($school,$exam)
    {
        $test = Exam::find()->where(['id'=>$exam])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }
        //该次考试 所选学校的文理科成绩信息
        $datalk = new DataColl();
        $sclk = $datalk->loadData($exam,$school);
        $avglkSchool = $datalk->getAvg();
        $datawk = new DataColw();
        $scwk = $datawk->loadData($exam,$school);
        $avgwkSchool = $datawk->getAvg();

        //所选考试和学校的班级文理科班级列表
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();
          //任教对应关系读取；
        $resModel = new ClassRespond();
        $resTeacher = $resModel->getTeachers($school,$exam);

        //考试对比数组是否存在
        if ($test->compare) {
            $test_compare = Exam::find()->where(['id'=>$test->compare])->one();
            $datalk_compare = new Datacoll();
            $sclk_compare = $datalk_compare->loadData($test_compare->id,$school);
            $avglkSchool_compare = $datalk_compare->getAvg();
            $datawk_compare = new Datacolw();
            $scwk_compare = $datawk_compare->loadData($test_compare->id,$school);
            $avgwkSchool_compare = $datawk_compare->getAvg();
        }

        //文理科班级成绩以及班级分析数据
        // max 最高分  avg 平均分 pass及格率 float进步率
        $scAnal = array();
        foreach ($bjlk as $keyl => $bjl) {
            $datalk->loadData($exam,$school,$bjl);

            $bjdata = $datalk_compare->loadData($test_compare->id,$school,$bjl);
            //上次考试没有数据
            if (empty($bjdata)) {
                $scAnal[$keyl]['float'] = 0;
                continue;
            }

          //  $scAnal[$keyl]['max'] = $datalk->getMax();
            $scAnal[$keyl]['avg'] = $datalk->getAvg();
            $scAnal[$keyl]['avg_last'] = $datalk_compare->getAvg();
          //  $scAnal[$keyl]['pass'] = $datalk->getPassed();
            $scAnal[$keyl]['float'] = $datalk->avgFloat($avglkSchool,$datalk_compare->getAvg(),$avglkSchool_compare);
        }
        $avgFloatw = array();//进步率数组
        $scAnaw = array();
        foreach ($bjwk as $keyw => $bjw) {
            $datawk->loadData($exam,$school,$bjw);
            $bjdata = $datawk_compare->loadData($test_compare->id,$school,$bjw);
             if (empty($bjdata)) {
                $scAnaw[$keyw]['float'] = 0;
                continue;
            }
         //   $scAnaw[$keyw]['max'] = $datawk->getMax();
            $scAnaw[$keyw]['avg'] = $datawk->getAvg();
            $scAnaw[$keyw]['avg_last'] = $datawk_compare->getAvg();
        //  $scAnaw[$keyw]['pass'] = $datawk->getPassed();
            $scAnaw[$keyw]['float'] = $datawk->avgFloat($avgwkSchool,$datawk_compare->getAvg(),$avgwkSchool_compare);
        }

       


        return $this->render('improve',[
            'school'=>$school,
            'exam'=>$test,
            'bjlk'=>$bjlk,
            'bjwk'=>$bjwk,
            'wksubjects'=>$datawk->getSubjects(),
            'lksubjects'=>$datalk->getSubjects(),
            'resTeacher'=>$resTeacher,
            'scAnal'=>$scAnal,
            'scAnaw'=>$scAnaw,

        ]);
    }


    public function actionBeyondline($school,$exam)
    {
        $test = Exam::find()->where(['id'=>$exam])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }

        $linetypearr = ['grade','subject'];
        if ($post = Yii::$app->request->post()) {
            if (in_array($post['linetype'], $linetypearr)) {
                 $linetype = $post['linetype'];
             } 
        }else{
            $linetype = current($linetypearr);
        }

        //该次考试 所选学校的文理科成绩信息
        $datalk = new DataColl();
        $sclk = $datalk->loadData($exam,$school);
        $avglkSchool = $datalk->getAvg();
        $datawk = new DataColw();
        $scwk = $datawk->loadData($exam,$school);
        $avgwkSchool = $datawk->getAvg();

       //所选考试和学校的班级文理科班级列表
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();

        $scAnal = array();
        foreach ($bjlk as $keyl => $bjl) {
            $datalk->loadData($exam,$school,$bjl);
           // $datalk_compare->loadData($test_compare->id,$school,$bjl);
            $scAnal[$keyl]['max'] = $datalk->getMax();
            $scAnal[$keyl]['avg'] = $datalk->getAvg();
            $scAnal[$keyl]['pass'] = $datalk->getPassed();
          //  $scAnal[$keyl]['float'] = $datalk->avgFloat($avglkSchool,$datalk_compare->getAvg(),$avglkSchool_compare);
        }
       // $avgFloatw = array();//进步率数组
        $scAnaw = array();
        foreach ($bjwk as $keyw => $bjw) {
            $datawk->loadData($exam,$school,$bjw);
        //    $datawk_compare->loadData($test_compare->id,$school,$bjw);
            $scAnaw[$keyw]['max'] = $datawk->getMax();
            $scAnaw[$keyw]['avg'] = $datawk->getAvg();
            $scAnaw[$keyw]['pass'] = $datawk->getPassed();
        //    $scAnaw[$keyw]['float'] = $datawk->avgFloat($avgwkSchool,$datawk_compare->getAvg(),$avgwkSchool_compare);
        }
        //任教对应关系读取；
        $resModel = new ClassRespond();
        $resTeacher = $resModel->getTeachers($school,$exam);

        $datalk->loadData($exam,$school,null,'zf desc',$linetype,'J');
        $datawk->loadData($exam,$school,null,'zf desc',$linetype,'J');

        $schoolLineStudentListlk = $datalk->getDistinct('stu_id','zf desc',$linetype,'J');
        $schoolLineStudentListwk = $datawk->getDistinct('stu_id','zf desc',$linetype,'J');
        $lkzfline = $datalk->getColomnMin('zf');
        $wkzfline = $datawk->getColomnMin('zf');

      //  var_export($lkzfline);
      //  exit();

        $lk_uponline = $datalk->getUponLine($exam,$school,$schoolLineStudentListlk,'J');
        $wk_uponline = $datawk->getUponLine($exam,$school,$schoolLineStudentListwk,'J');

        $resTask = $resModel->getLineTask($school,$exam,$linetype);


        return $this->render('beyondline',[
            'school'=>$school,
            'exam'=>$test,
            'bjlk'=>$bjlk,
            'bjwk'=>$bjwk,
            'scAnal'=>$scAnal,
            'scAnaw'=>$scAnaw,
            'lkuponline'=>$lk_uponline,
            'wkuponline'=>$wk_uponline,
            'wksubjects'=>$datawk->getSubjects(),
            'lksubjects'=>$datalk->getSubjects(),
            'resTeacher'=>$resTeacher,
            'resTask'=>$resTask,
            'linetype'=>$linetype,
        ]);


    }


    //班级成绩的分析
    public function actionBj($school,$exam,$bj=null,$export=0)
    {
        $test = Exam::findOne($exam);
        $compareExam = $test->compare;
        
        $datalk = new DataColl();
        $datawk = new DataColw();
        $sclk = $datalk->loadData($exam,$school);
        $scwk = $datawk->loadData($exam,$school);
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();
        //班级信息处理
        $bjarr1 = array_merge($bjlk,$bjwk);
        sort($bjarr1);
        foreach ($bjarr1 as $key => $value) {
           $bjarr[$value] = $value;
        }
        //获取班级 判断是否有GET和POST传入
        if ($bj==null) { $bj = current($bjlk);}
        if ($post = Yii::$app->request->post()) {
           $bj = $post['bj'];
        }

        $type = in_array($bj, $bjlk)?'lk':'wk';


        if ($compareExam) {
            $cana = new DataCollection($type);
            $cana->loadData($compareExam,$school);
            $compareArrayCompare = $cana->getScoreList();
            $cana->loadData($compareExam,$school,$bj,'zf desc');
            $rankCompare = $cana->getScoreRank($compareArrayCompare);
        }else{
            $rankCompare = null;
        }

        //年级成绩，返回数组用于显示科目排名
        $ana = new DataCollection($type);
        $ana->loadData($exam,$school,null,'zf desc');

        $compareArray = $ana->getScoreList();
        $scbj = $ana->loadData($exam,$school,$bj,'zf desc');
        $rank = $ana->getScoreRank($compareArray);

        //准备导出数据
        //static function export($title='export',$headerArr=null,Array $data)
        if($export == 1)
        {
            $header = ["编号","考号","姓名","学校","班级"];
            
            $subjects = $ana->getSubjects();
            foreach ($subjects as $key => $subject) {
                $subjectName = CommonFunction::getSubjects()[$subject];
                $header[] = $subjectName."得分";
                $header[] = $subjectName."排名";
                $header[] = $subjectName."升降";
            }

            $data = array();
            $key =1;
            foreach ($scbj as $keys => $sc) {
                $data[$key]['id'] = $key;
                $data[$key]['username'] = $sc->stu_id;
                $data[$key]['name'] = $sc->stu_name;
                $data[$key]['school'] = $sc->stu_school;
                $data[$key]['class'] = $sc->stu_class;
                foreach ($subjects as $keysubject=> $subject) {                  
                    $data[$key][$subject] = $sc->$subject;
                    if (isset($rankCompare[$sc->stu_id][$subject])) {
                        $float = $rankCompare[$sc->stu_id][$subject]-$rank[$sc->stu_id][$subject];
                    }else{
                        $float = 0;
                    }
                $data[$key][$subject.'rank'] = $rank[$sc->stu_id][$subject];
                $data[$key][$subject.'float'] = $float;
                }
                $key++;
            }

          CommonFunction::export('export',$header,$data);
           
        }


        //$this->export('班级成绩',null,$scbj);
        return $this->render('bj',[
            'school'=>$school,
            'exam'=>$test,
            'bj'=>$bj,
            'bjarr'=>$bjarr,
            'type'=>$type,
            'subjects'=>$ana->getSubjects(),
            'scbj'=>$scbj,
            'rank' => $rank,
            'rankCompare'=>$rankCompare,
            'export'=>$export,
        ]);
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
